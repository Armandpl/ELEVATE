<?php
	$errors = true;//On affiche pas les erreurs
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require("require/config.php");//On récupère les pass de la BDD + la clé stripe
	require("vendor/autoload.php");//On load la lib stripe avec composer

	\Stripe\Stripe::setApiKey($StripeKey);//On donne notre apiKey à Stripe

	$token = $_POST['stripeToken'];//On récupère le token retourné par stripe

	$success = 0;//Variable qu'on passe à 1 si on arriver à "charger" la carte

	try {//On débite la carte du client
		$charge = \Stripe\Charge::create(array(
		  "amount" => 15000,
		  "currency" => "eur",
		  "description" => "ELEVATE skateboard",
		  "source" => $token,
		));
		$success = 1;
	} catch(\Stripe\Error\Card $e) {//Si il y a une erreur
	  if($errors){
		  $body = $e->getJsonBody();
		  $err  = $body['error'];

		  print('Status is:' . $e->getHttpStatus() . "\n");
		  print('Type is:' . $err['type'] . "\n");
		  print('Code is:' . $err['code'] . "\n");
		  // param is '' in this case
		  print('Param is:' . $err['param'] . "\n");
		  print('Message is:' . $err['message'] . "\n");
	  }
	} catch (\Stripe\Error\RateLimit $e) {
	  // Too many requests made to the API too quickly
	} catch (\Stripe\Error\InvalidRequest $e) {
	  // Invalid parameters were supplied to Stripe's API
	} catch (\Stripe\Error\Authentication $e) {
	  // Authentication with Stripe's API failed
	  // (maybe you changed API keys recently)
	} catch (\Stripe\Error\ApiConnection $e) {
	  // Network communication with Stripe failed
	} catch (\Stripe\Error\Base $e) {
	  // Display a very generic error to the user, and maybe send
	  // yourself an email
	} catch (Exception $e) {
	  // Something else happened, completely unrelated to Stripe
	}

	$order_success = 0;//variable qu'on passe a un si on réussi à créer la commande

	if($success == 1)//Si la carte est passée
	{
		try//On se co à la BDD
		{
			$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
		}
		catch(Exception $e)//Si la co échoue
		{
		    die('Erreur : '.$e->getMessage());
		}

		try
		{
			$order_number=uniqid(rand(1000,9999), false); // On génère un numéro de commande unique
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//On active les erreurs
			//on prépare la requête SQL
			$request = $bdd->prepare("INSERT INTO ORDERS (order_number, order_date, status, track_number, product, name, surname, email, address, address_2, zipcode, city, country) VALUES (:order_number, :order_date, :status, :track_number, :product, :name, :surname, :email, :address, :address_2, :zipcode, :city, :country)");
			$request->execute(array(
				"order_number" => $order_number,
				"order_date" => date("Y-m-d"),//On récupère la date
				"status" => "paid",
				"track_number" => "none",//Numéro de tracking du transporteur que l'on a pas encore
				"product" => "ELEVATE CRUISER",
				"name" => $_POST["name"],
				"surname" => $_POST["surname"],
				"email" => $_POST["email"],
				"address" => $_POST["address"],
				"address_2" => $_POST["address_2"],
				"zipcode" => $_POST["zipcode"],
				"city" => $_POST["city"],
				"country" => $_POST["country"]
			));
			$request->closeCursor();
			require("require/sendMail.php");
			sendConfirmation($_POST["email"], $order_number, $_POST["surname"]);
			$order_success = 1;
		}
		catch(Exception $e)
		{
			if($errors)
			{
				var_dump($e);
			}
		}
	}
?>
<!DOCTYPE html> 
<html>

<head>
	<?php require("require/head.php");?>	
</head>

<body>
	<!--NAV BAR-->
	<?php require("require/nav.php");?>

	<section id="thanks" class="container-fluid vertical-center">
			<div class="container text-center">
				<?php
					if(!isset($_POST['stripeToken']) && !isset($_POST['name']))//Si on a ni token Stripe ni nom, on est sûr que le formulaire n'a pas été envoyé, on redirige vers l'acceuil
					{
						header('Location: index.php');
							exit();
					}
					elseif($success == 0)//Si on a pas réussi à débiter la carte
					{
						echo("<h1>Sorry, we couldn't charge your card ! 
							Please try again or contact our support.</h1>");
					}
					elseif($order_success==0)
					{
						echo("<h1>Sorry, there was an error while creating your order.
							Please contact our support.</h1>");
					}
					else
					{
						echo("<h1>Thanks for your order !</h1>	
						<h2>A confirmation e-mail has been sent to your inbox at ".$_POST["email"].". 
						Your order number is ".$order_number.".</h2>");
					}
				?>					
			</div>	
	</section>
</body>

</html>