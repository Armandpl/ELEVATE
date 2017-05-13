 <!DOCTYPE html> 
<html>

<head>
	<?php require("require/head.php");?>		
</head>

<?php require("require/config.php");?>

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
						    data-key=<?php echo("'".$StripeKey."'");?>
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