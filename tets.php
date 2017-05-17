<?php
// Sous MAMP (Mac)
$bite = $_POST['nom de variable'];
$bdd = new PDO('mysql:host=localhost;dbname=ELEVATE;charset=utf8', 'root', 'root');

$result = $bdd->query('SELECT `date` FROM `ORDERS` WHERE `numero='.$bite.'`');
while($data = $result->fetch())
{	
	echo $data['date'];				
}
$result->closeCursor();

?>
<input type="text" name="nom de variable" class="form-control" id="inputcommande" require>