 <!DOCTYPE html> 
<html>
	<?php require("require/head.php");?>
<head>
		
</head>

<body id="wrap">
	<!--NAV BAR-->
	<?php require("require/nav.php");?>

	<section id="main_content">
		<div id="guts">
			<section class="container-fluid nav-fix" id="track">
				<div class="row vertical-center">
				
						<div class="col-xs-offset-1 vertical-center horizontal-center "style="button: 1px solid green;">
							<div class="input-group">
							  		<form action="order.php" method="POST">
							  		<div class="row">
							  		<div class="col-xs-12">
							  		<div  class="form-group">
							  		<label for="inputcommande">Votre n° de commande</label>
							  		<input type="text" name="commande" class="form-control" id="inputcommande" require>
							  		</div>
							  		</div>
							  		<button type="submit" class="btn btn-primary">Envoyer</button>
							  		</form>						      
						    </div><!-- /input-group -->							
						</div>
				</div>	
			</section>
		</div>
	</section>
</body>

</html>