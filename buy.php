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

					<div class="col-xs-12 col-sm-5 offset-sm-1 text-center" id="board_col">
						<img src="img/board.png" class="img-fluid mx-auto"/>			
					</div>

					<div class="col-xs-12 col-sm-5">
						<div class="row h-100">
							<div class="col-xs-12 my-auto" id="description">
								<h2>ELEVATE Cruiser</h2>
				                
				                <p>Elegant homemade cruiser board. Made out of strong canadian mapple. Won't break.</p>	

				                <button type="button" class="btn btn-primary btn-lg" id="order_button">ORDER</button>	
			                </div>	

		                	<form action="/charge" method="post" class="col-xs-12 col-sm-8 my-auto" id="payment_form" style="display: none;">
								<div class="form-group">
								  <label for="name">Name</label>
								  <input class="form-control form-control-sm" type="text" placeholder="Your name" id="name" required>
								</div>

								<div class="form-group">
								  <label for="surname">Surname</label>
								  <input class="form-control form-control-sm" type="text" placeholder="Your surname" id="surname" required>
								</div>

								<div class="form-group">
								  <label for="email">Email</label>
								  <input class="form-control form-control-sm" type="email" placeholder="email@example.com" id="email" required>
								</div>

								<div class="form-group">
								  <label for="surname">Country</label>
								  <input class="form-control form-control-sm" type="text"  id="surname" required>
								</div>

								<div class="form-group">
								  <label for="surname">Address</label>
								  <input class="form-control form-control-sm" type="text" placeholder="Your adress" id="surname" required>
								</div>

								<div class="form-row form-group">
								  	<label for="card-element">
								      Credit or debit card
								    </label>
								    <div id="card-element" class="form-control form-control-sm">
								      <!-- a Stripe Element will be inserted here. -->
								    </div>

								    <!-- Used to display Element errors -->
								    <div id="card-errors" role="alert"></div>
								</div>

								<button type="button" class="btn btn-default" id="cancel_button">Cancel</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>	

		                </div>	
					</div>
						
				</div>	
			</section>
		</div>
	</section>

	<script type="text/javascript" defer>

 	$(document).ready(function() {
 		
 		$("#order_button").click(function() { //Pour afficher le formulaire de paiement lors du clic du bouton order
    		$("#description").hide();
    		if($(window).width()<576){$("#board_col").hide();}
    		$("#payment_form").show("slide");
		});
		$("#cancel_button").click(function() {
    		$("#payment_form").hide();
    		$("#description").show("slide");
    		if($(window).width()<576){$("#board_col").show("slide");}
		});

		var stripe = Stripe('pk_test_G3PlnRvo1eeDlPEpe4qYoX1P');
		var elements = stripe.elements();

			 	// Custom styling can be passed to options when creating an Element.
		var style = {
		  base: {
		    color: '#32325d',
		    lineHeight: '24px',
		    fontSmoothing: 'antialiased',
		    fontSize: '16px',
		    '::placeholder': {
		      color: '#636c72'
		    }
		  },
		  invalid: {
		    color: '#fa755a',
		    iconColor: '#fa755a'
		  }
		};

		// Create an instance of the card Element
		var card = elements.create('card', {style: style});

		// Add an instance of the card Element into the `card-element` <div>
		card.mount('#card-element');

		card.addEventListener('change', function(event) {
		  var displayError = document.getElementById('card-errors');
		  if (event.error) {
		    displayError.textContent = event.error.message;
		  } else {
		    displayError.textContent = '';
		  }
		});
 	});

	</script>

</body>

</html>