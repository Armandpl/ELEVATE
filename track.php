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
							  		<?php
function test_ref(&$var,$test_function='',$negate=false) {
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
test_ref($b,'is_number');  //returns false, with an error.
?>
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