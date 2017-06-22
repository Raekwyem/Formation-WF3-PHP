<?php
// sur formulaire2.php: mettre en place un formulaire avec deux champs (pseudo & mail) + le bouton de validation
// ce formulaire doit envoyer les informations saisies sur la page formulaire2_resultat.php
// faire en sorte d'afficher les informations reçues (var_dump ou print_r)
// ensuite afficher proprement les informations saisies
// attention en cas d'erreur, par exemple si j'arrive directement sur formulaire2_resultat.php sans être passé par la validation du formulaire, y a-t-il des erreurs
// pour aller plus, tester la taille du pseudo, il doit avoir entre 4 et 14 caractères inclus
// si la taille est ok: on affiche "le pseudo est : ..."
// s'il y a un souci sur la taille du pseudo, on affiche un message à l'utilisateur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<style>
		* { font-family: sans-serif; }
		form { width: 30%; margin: 0 auto; }
		label { display: inline-block; width: 100%; font-style: italic; }
		input, textarea { height: 30px; border: 1px solid #eee; width: 100%; resize: none;}
		#submit { width: 140px; }
	</style>
	<title>Formulaire</title>
</head>
<body>
	<form method="post" action="formulaire2_resultat.php">
		<label for="pseudo">Pseudo</label>
		<input type="text" name="pseudo" id="pseudo" value="" required />

		<label for="email">Email</label>
		<input type="email" id="email" name="email" value="" /><br /><br />

		<input type="submit" id="submit" value="Valider" />
	</form>
</body>
</html>