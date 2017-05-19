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

			<section class="container-fluid nav-fix" id="track">
				<div class="row vertical-center">
			  		<form action="order" method="POST" class="col-6 offset-3">

				  		<div  class="form-group">
					  		<label for="commande">Votre n° de commande</label>
					  		<input type="text" name="commande" class="form-control" id="commande" require>
				  		</div>

				  		<button type="submit" class="btn btn-primary">Envoyer</button>
			  		</form>						      						
				</div>	
			</section>

		</div>
	</section>
</body>

</html>

	<!--<?php
	/*function test_ref(&$var,$test_function='',$negate=false) {
	    $stat = true;
	    if(!isset($var)) $stat = false;
	    if (!empty($test_function) && function_exists($test_function)){
	        $stat = $test_function($var);
	        $stat = ($negate) ? $stat^1 : $stat;
	    }
	    elseif($test_function == 'empty') {
	        $stat = empty($var);
	        $stat = ($negate) ? $stat^1 : $stat;
	    }
	    elseif (!function_exists($test_function)) {
	        $stat = false; 
	        trigger_error("$test_function() is not a valid function");
	    }
	    $stat = ($stat) ? true : false;
	    return $stat;
	}
	$a = '';
	$b = '15';

	test_ref($a,'empty',true);  //False
	test_ref($a,'is_int');  //False
	test_ref($a,'is_numeric');  //False
	test_ref($b,'empty',true);  //true
	test_ref($b,'is_int');  //False
	test_ref($b,'is_numeric');  //false
	test_ref($unset,'is_numeric');  //false
	test_ref($b,'is_number');  //returns false, with an error.*/
?>-->