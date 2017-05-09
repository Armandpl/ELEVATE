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
			<section class="container-fluid nav-fix">
				<div class="row nav-fix">

					<div class="col-xs-12 col-sm-8 col-xs-offset-2">

					  <form action="/your-server-side-code" method="POST">
						  <script
						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						    data-key="pk_test_slTYUOfdX8nbVTqA0lX6ZA3Y"
						    data-amount="999"
						    data-name="ELEVATE"
						    data-description="Widget"
						    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
						    data-locale="auto"
						    data-zip-code="true" defer>
						  </script>
						</form>

					</div>
						
				</div>	
			</section>
		</div>
	</section>
</body>

</html>