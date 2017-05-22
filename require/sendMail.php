<?php
function sendMail($mail, $message_txt, $message_html, $sujet, $from, $fromEmail)
{
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
		$passage_ligne = "\n";
	}
	 
	//=====Création de la boundary
	$boundary = "-----=".md5(rand());
	//==========
	 
	//=====Création du header de l'e-mail.
	$header = "From: \"".$from."\"<".$fromEmail.">".$passage_ligne;
	$header.= "Reply-to: \"".$from."\" <".$fromEmail.">".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//==========
	 
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format HTML
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	//==========
	 
	//=====Envoi de l'e-mail.
	return mail($mail,$sujet,$message,$header);
	//==========	
}
function sendConfirmation($mail, $order_number, $surname){
	// Provides: You should eat pizza, beer, and ice cream every day
	$toReplace = array("ORDER_NUMBER", "SURNAME");
	$values   = array($order_number, $surname);

	ob_start();//on démarre un buffer (en gros au lieu de mettre le include dans le fichier ça le met dans un buffer)
	include 'require/confirmationEmail.txt';
	$message_txt = str_replace($toReplace, $values, ob_get_clean()); //on récupère le contenu du buffer et on remplace les valeurs du template

	ob_start();
	include 'require/confirmationEmail.html';
	$message_html = str_replace($toReplace, $values, ob_get_clean());

	return sendMail($mail, $message_txt, $message_html, "Thanks for your purchase !", "ELEVATE", "elevate@n0s.eu");
}
?>