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

		                	<form action="charge" method="post" class="col-xs-12 col-sm-8 my-auto" id="payment_form">
								
		                		<div id="contact" style="display: none;">
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

									<button type="button" class="btn btn-default" id="cancel_button">Cancel</button>
									<button type="button" class="btn btn-primary" id="contact_next">Next</button>
								</div>
								
								<div id="whole_address" style="display: none;">
									<div class="form-group">
									  <label for="country">Country</label>
									  <input class="form-control form-control-sm" type="text"  id="country" required>
									</div>

									<div class="form-group">
									  <label for="address">Address</label>
									  <input class="form-control form-control-sm" type="text" placeholder="Your adress" id="address" required>
									</div>

									<div class="form-group">
									  <label for="address_2">Additional address details</label>
									  <input class="form-control form-control-sm" type="text" placeholder="Leave empty if you need" id="address_2">
									</div>

									<div class="form-group">
									  <label for="city">City</label>
									  <input class="form-control form-control-sm" type="text" placeholder="Your city" id="city" required>
									</div>

									<div class="form-group">
									  <label for="zipcode">Postal/zip code</label>
									  <input class="form-control form-control-sm" type="number" placeholder="33667" id="zipcode" required>
									</div>

									<button type="button" class="btn btn-default" id="address_back">Back</button>
									<button type="button" class="btn btn-primary" id="address_next">Next</button>
								</div>

								<div id="payment" style="display: none;">
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

									<button type="button" class="btn btn-default" id="payment_back">Back</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>	

		                </div>	
					</div>
						
				</div>	
			</section>
		</div>
	</section>

	<script type="text/javascript" defer>

 	$(document).ready(function() {

 		$("#country").countrySelect();
 		
 		$("#order_button").click(function() { //Pour afficher le formulaire de paiement lors du clic du bouton order
    		$("#description").hide();
    		if($(window).width()<576){$("#board_col").hide();}//Si on est sur tel, on cache la board
    		$("#contact").slideDown();
		});

		$("#cancel_button").click(function() {
    		$("#contact").hide();
    		$("#description").slideDown();
    		if($(window).width()<576){$("#board_col").slideDown();}
		});

		$("#contact_next").click(function() {
    		$("#contact").hide();
    		$("#whole_address").slideDown();
		});

		$("#address_back").click(function() {
    		$("#whole_address").hide();
    		$("#contact").slideDown();
		});

		$("#address_next").click(function() {
    		$("#whole_address").hide();
    		$("#payment").slideDown();
		});

		$("#payment_back").click(function() {
    		$("#payment").hide();
    		$("#whole_address").slideDown();
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

		// Create a token or display an error when the form is submitted.
			var form = document.getElementById('payment_form');
			form.addEventListener('submit', function(event) {
			  event.preventDefault();

			  stripe.createToken(card).then(function(result) {
			    if (result.error) {
			      // Inform the user if there was an error
			      var errorElement = document.getElementById('card-errors');
			      errorElement.textContent = result.error.message;
			    } else {
			      // Send the token to your server
			      stripeTokenHandler(result.token);
			    }
			  });
			});

 	});

 	function stripeTokenHandler(token) {
	  // Insert the token ID into the form so it gets submitted to the server
	  var form = document.getElementById('payment_form');
	  var hiddenInput = document.createElement('input');
	  hiddenInput.setAttribute('type', 'hidden');
	  hiddenInput.setAttribute('name', 'stripeToken');
	  hiddenInput.setAttribute('value', token.id);
	  form.appendChild(hiddenInput);

	  // Submit the form
	  form.submit();
	}

	</script>

</body>

</html>