<?php
	error_reporting(E_ALL);
	ini_set('display_errors','on');
	require("require/config.php");
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
			//on prépare la requête SQL
			$request = $bdd->prepare("INSERT INTO 'ORDERS' (order_number, order_date, status, track_number, product, name, surname, email, address, address_2, zipcode, city, country) VALUES (:order_number, :order_date, :status, :track_number, :product, :name, :surname, :email, :address, :address_2, :zipcode, :city, :country)");
			$request->execute(array(
				"order_number" => uniqid(rand(1000,9999), false),//On génère un numéro de commande unique
				"order_date" => date("Y-m-d"),//On récupère la date
				"status" => "paid",
				"track_number" => "none",//Numéro de tracking du transporteur que l'on a pas encore
				"product" => "ELEVATE CRUISER",
				"name" => "test",
				"surname" => "test",
				"email" => "test",
				"address" => "test",
				"address_2" => "test",
				"zipcode" => "test",
				"city" => "test",
				"country" => "test"
			));
			$request->closeCursor();
			echo("Merci de votre commande!");

		}
		catch(Exception $e)
		{
			echo("erreur lors de la création de la commmande");
		}
?>