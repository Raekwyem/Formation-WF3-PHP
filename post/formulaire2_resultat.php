<meta charset="utf-8">
<style type="text/css">
	* { font-family: sans-serif; }
	h1 { padding: 10px; background-color: navy; color: white; }
	.erreur { margin-top: 20px; background-color: darkred; }
	.succes { margin-top: 20px; background-color: darkgreen; }
</style>
<?php
	echo '<pre>'; print_r($_POST); echo '</pre>';
	if(isset($_POST['pseudo']) && isset($_POST['email']))
	{
		echo 'Le pseudo est: ' . $_POST['pseudo'];
		echo '<br />';
		echo 'L\'email est: ' . $_POST['email'];
		echo '<br />';

	}
	if((strlen($_POST['pseudo']) <= 14) && (strlen($_POST['pseudo']) >= 4))
	{
		echo 'Le pseudo est valide';
		echo '<br />';
	}
	else{
		echo 'Veuillez entrer un nouveau pseudo ayant entre 4 et 14 caractères compris svp';
		echo '<br />';
	}
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
	{
    	echo 'Cet email est correct.';
    	echo '<br />';
	} 
	else{
    	echo 'Cet email a un format non adapté.';
    	echo '<br />';
	}
/*
$message = "";
if(isset($_POST['pseudo']) && isset($_POST['email']))
{
	$pseudo = $_POST['pseudo'];
	$email = $_POST['email'];
	if(iconv_strlen($pseudo) > 3 && iconv_strlen($pseudo) < 15)
	{
		$message .= '<p class="succes">Votre pseudo est: ' . $pseudo .'</p>';
	}
	else {
		$message .= '<p class="erreur">Veuillez entrer un nouveau pseudo ayant entre 4 et 14 caractères compris svp</p>';
	}
}
echo '<h1>Résultats:</h1>';
echo $message;
 */
}
?>
