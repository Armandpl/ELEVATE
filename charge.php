<?php
	require("require/config.php");//On récupère les pass de la BDD + la clé stripe
	require("vendor/autoload.php");//On load la lib stripe avec composer
	\Stripe\Stripe::setApiKey($StripeKey);
	$token = $_POST['stripeToken'];//On récupère le token retourné par stripe
	$success=0;//Variable qu'on passe à 1 si on arriver à "charger" la carte
	try {//On "charge" la carte du client
		$charge = \Stripe\Charge::create(array(
		  "amount" => 150,
		  "currency" => "eur",
		  "description" => "ELEVATE skateboard",
		  "source" => $token,
		));
		$success=1;
	} catch(\Stripe\Error\Card $e) {//Si il y a une erreur
	  $body = $e->getJsonBody();
	  $err  = $body['error'];

	  print('Status is:' . $e->getHttpStatus() . "\n");
	  print('Type is:' . $err['type'] . "\n");
	  print('Code is:' . $err['code'] . "\n");
	  // param is '' in this case
	  print('Param is:' . $err['param'] . "\n");
	  print('Message is:' . $err['message'] . "\n");
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

	if($success==1)//Si la carte est passée
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
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//On active les erreurs
			//on prépare la requête SQL
			$request = $bdd->prepare("INSERT INTO ORDERS (order_number, order_date, status, track_number, product, name, surname, email, address, address_2, zipcode, city, country) VALUES (:order_number, :order_date, :status, :track_number, :product, :name, :surname, :email, :address, :address_2, :zipcode, :city, :country)");
			$request->execute(array(
				"order_number" => uniqid(rand(1000,9999), false),//On génère un numéro de commande unique
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
			echo("Merci de votre commande!");
		}
		catch(Exception $e)
		{
			echo("erreur lors de la création de la commmande");
			var_dump($e);
		}
	}