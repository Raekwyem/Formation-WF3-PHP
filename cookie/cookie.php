<?php
// récupération du choix de l'utilisateur ou cas par défaut
if(isset($_GET['langue']))
{
	$langue = $_GET['langue']; // choix de l'utilisateur
}
elseif(isset($_COOKIE['langue']))
{
	$langue = $_COOKIE['langue'];
}
else{
	$langue = 'fr'; // cas par défaut
	// $langue = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); // cas par défaut
}

// nombre de seconde dans une année
$un_an = 365*24*3600; // nb_jour*nb_heure*nb_seconde

// création d'un cookie sur le poste utilisateur
// /!\ la fonction setCookie() doit être appelé avant le moindre affichage dans la page
// pour générer un cookie: 3 arguments setCookie(nom, valeur, duree_de_vie)
setCookie("langue", $langue, time()+$un_an);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<ul>
			<li><a href="?langue=fr">France</a></li>
			<li><a href="?langue=de">Allemagne</a></li>
			<li><a href="?langue=it">Italie</a></li>
			<li><a href="?langue=jp">Japon</a></li>
		</ul>	
	<?php
		// affichage d'un texte selon la langue
		switch($langue) // on teste la valeur de $langue
		{
			case 'fr':
				echo '<p>Bonjour,<br /> vous visitez le site en langue française</p>';
			break;
			case 'de':
				echo '<p>Hallo,<br /> besuchen Sie die Seite auf Deutsch</p>';
			break;
			case 'it':
				echo '<p>Ciao,<br /> si visita il sito in lingua italiana</p>';
			break;
			case 'jp':
				echo '<p>こんにちは、<br /> あなたは日本語でサイトにアクセスしてください</p>';
			break;
			default:
				echo '<p>Langue inconnue !</p>';
			break;
		}

		// echo '<pre>'; print_r($_SERVER); echo '</pre>';
		// il est possible de récupérer la lanque du navigateur de l'utilisateur
		echo 'langue du navigateur: ' . substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) . '<br />';
		echo time(); // time() affiche la valeur du timestamp
	?>
	</body>
</html>