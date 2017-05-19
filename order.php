 <!DOCTYPE html> 
<html>

<head>
  <?php require("require/head.php");?>		
</head>

<body id="wrap">
	<!--NAV BAR-->
	<?php require("require/nav.php");?>
  <?php
// Sous MAMP (Mac)
$bdd = new PDO('mysql:host=localhost;dbname=ELEVATE;charset=utf8', 'root', 'loutre');
 foreach($slides as $slide)
 
?>
<section id="main_content">
		    <div id="guts">
	         <section class="container-fluid nav-fix" id="order">
				      <div class="row vertical-center">
				         <h1>Colis n<?php echo $_POST['commande'];?> </h1>
	               <div class="col-offset-2 col-8" style="border: 1px">           
  	             <table class="table" style="border: 1px solid red">               
                   <thead>
                      <tr>
                      <th><?php echo $_POST['commande'];?> </th>
                      <th>Arrivé</th>    
                      </tr>
                   </thead>

                   <tbody>
                    <tr>
                    <td>Poids de la commande</td>
                    <td><?php echo $_POST['nom de variable'];?></td>
          
                    </tr>
                    <tr>
                    <td>Taille de la planche</td>
                    <td>1,12m</td>
         
                    </tr>
                    <tr>
                    <td>Composant </td>
                    <td>Bois</td>
          
                    </tr>
                  </tbody>
                 </table>
   						   
                  

              </div>
            </div>
          </section>
        </div>
    
</section>


</body>

</html>