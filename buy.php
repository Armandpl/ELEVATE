 <!DOCTYPE html> 
<html>

<head>
	<?php require("require/head.php");?>		
</head>

<body id="wrap">
	<!--NAV BAR-->
	<?php require("require/nav.php");?>

	<section id="main_content">
		<div id="guts">
			<section class="container-fluid nav-fix">
				<div class="row">

					<div class="col-xs-12 col-sm-5 offset-sm-1 text-center">
						<img src="img/board.png" height="100" class="img-fluid mx-auto"/>			
					</div>

					<div class="col-xs-12 col-sm-5">
						<div class="row h-100">
							<div class="my-auto" id="description">
								<h2>ELEVATE Cruiser</h2>
				                
				                <p>Elegant homemade cruiser board. Made out of strong canadian mapple. Won't break.</p>	

				                <button type="button" class="btn btn-primary btn-lg" id="order_button">ORDER</button>	
			                </div>	

			                <div class="my-auto" id="payment_form" style="display: none;">

			                	<form action="coucou.php">
									<div class="form-group row">
									  <label for="name">Name</label>
									  <input class="form-control" type="text" placeholder="Name" id="name">
									</div>

									<!--<div class="form-group row">
									  <label for="surname">Surname</label>
									  <input class="form-control" type="text" placeholder="Surname" id="surname">
									</div>

									<div class="form-group row">
									  <label for="email">Email</label>
									  <input class="form-control" type="email" placeholder="email@example.com" id="email">
									</div>

									<div class="form-group row">
									  <label for="tel">Tel</label>
									  <input class="form-control" type="tel" placeholder="33691906176" id="tel">
									</div>

									<div class="form-group row">
									  <label for="number">Credit or debit card</label>
									  <input class="form-control" type="number" placeholder="4242 4242 4242 4242" id="number">
									</div>-->

									<div class="form-group row">
									  <label for="expiration">Expiration date</label>
									  <input class="form-control" type="month" id="expiration">
									</div>

									<div class="form-group row">
									  <label for="cvc">CVC</label>
									  <input class="form-control" type="number" placeholder="667" id="cvc">
									</div>

									<button type="button" class="btn btn-default" id="cancel_button">Cancel</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</form>

			                </div>	

		                </div>	
					</div>
						
				</div>	
			</section>
		</div>
	</section>

	<script type="text/javascript" defer>
	//var stripe = Stripe('');
	//var elements = stripe.elements();

 	$(document).ready(function() {
 		$("#order_button").click(function() {
    		$("#description").hide();
    		$("#payment_form").show("slide");
		});
		$("#cancel_button").click(function() {
    		$("#payment_form").hide();
    		$("#description").show("slide");
		});
 	});

	</script>

</body>

</html>