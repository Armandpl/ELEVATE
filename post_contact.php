post_contact.php
<?php
var_dump ($_POST);
$errors = [] ;

if(!array_key_exists('name', $_POST) $_POST['name'] == '') {
	$errors ['name'] = "vous n'avez pas renseigné votre nom" ;
}
if(!array_key_exists('n° de compte', $_POST) $_POST['name'] == '') {
	$errors ['name'] = "vous n'avez pas renseigné votre n° de commande" ;
}
mail('hector.groux@hotmail.fr', 'suivi de la commande', )