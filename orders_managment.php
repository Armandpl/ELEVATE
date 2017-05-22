 <!DOCTYPE html> 
<html>

<head>
	<title>Orders</title>

	<!--Loading CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<!--Loading JS-->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous" defer></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous" defer></script>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
		<section class="container-fluid">
			<div class="row">
				<div class="form-group col-sm-8 offset-2 mt-1">
				    <input class="form-control" type="search" placeholder="search" id="search">
				</div>
			</div>

			<div class="row">
				<table class="table col-12">
				  <thead>
				    <tr>
				      <th>#</th>
				      <th>Date</th>
				      <th>Status</th>
				      <th>Track</th>
				      <th>Product</th>
				      <th>Name</th>
				      <th>Surname</th>
				      <th>E-mail</th>
				      <th>Address</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				  	require("require/config.php");
				  	try//on se co à la BDD
				  	{
						$bdd = new PDO("mysql:host=" . $host . ";dbname=" . $dbname .";charset=utf8", $user, $pass);
					}
					catch (Exception $e){
					    die($e->getMessage());
					}

					$result = $bdd->query('SELECT * FROM ORDERS ORDER BY order_date DESC');//on récupère toute les commande classées par date
					while($data = $result->fetch())
					{	
						echo("<tr>
						      <th>".$data['order_number']."</th>
						      <td>".$data['order_date']."</td>
						      <td>".$data['status']."</td>
						      <td>".$data['track_number']."</td>
						      <td>".$data['product']."</td>
						      <td>".$data['name']."</td>
						      <td>".$data['surname']."</td>
						      <td>".$data['email']."</td>
						      <td>".$data['address']."</br>".$data['address_2']."<br>".$data['zipcode'].$data['city']."<br>".$data['country']."</td>
						    </tr>");
					}
					$result->closeCursor();
				  	?>
				  </tbody>
				</table>
			</div>					
		</section>
		<script type="text/javascript" defer>
			$(document).keyup(function(touche){ // on écoute l'évènement keyup()

			    var appui = touche.which || touche.keyCode; // le code est compatible tous navigateurs grâce à ces deux propriétés

			    if(appui == 13){ // si le code de la touche est égal à 13 (Entrée)
			        search_update();
			    }
			});


			 	function search_update(){//Fonction masque les commandes qui ne contiennent pas le mot tapé dans la barre de recherche
			 			$('tbody tr').each(function(){
			 			if(!$(this).html().match($("#search").val())){
				 			$(this).hide();
			 			}
			 			else{
			 				$(this).show();	
			 			}
			 		});
			 	}
		</script>
</body>

</html>