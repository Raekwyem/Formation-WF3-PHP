<?php
// ici nous allons avoir un formulaire permettant à l'utilisateur d'écrire un commentaire. Il faudra enregistrer ce commentaire en BDD pour l'afficher ensuite dans la page.
// 1 - faire un formulaire avec ces champs:
	// pseudo (type text)
	// commentaire (textarea)
// 2 - récupération des saisies et affichage sur la meme page
// 3 - insertion des données dans la BDD
// 4 - affichage des commentaires dans la page (récupération depuis la bdd + traitement)
// 5 - afficher les derniers commentaires (enregistrés) en premier dans la page
// 6 - afficher le nombre de commentaires
// 7 - afficher la date et l'heure du commentaire en francais
// 8 - css
	$pdo = new PDO('mysql:host=localhost;dbname=commentaire', 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	$message_utilisateur = ""; //variable pour afficher les messages
	if(isset($_POST['pseudo']) && isset($_POST['message']))
	{
		// htmlentities() permet d'éviter l'injection de code(sql, css, xss, etc...) cette fonction transforme les caractères tels que < > & ... en entites html, cela permet d'avoir un code source propre et de bloquer les injections
		// le deuxième argument ENT_QUOTES permet la prise en charge également des " et '
		$pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES);
		$message = htmlentities($_POST['message'], ENT_QUOTES);
		if(!empty($pseudo) && !empty($message))
		{
		// enregistrement avec la methode prepare car les informations venant du formulaire peuvent contenir des injections sql
		$enregistrement = $pdo->prepare("INSERT INTO commentaire(pseudo, message, date) VALUES (:pseudo, :message, NOW())");
		// echo echo '<pre>'; print_r(get_class_methods($resultat)); echo '</pre>';
		$enregistrement->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
		$enregistrement->bindParam(":message", $message, PDO::PARAM_STR);
		$enregistrement->execute();
		// $message_utilisateur = "<div style='color: white; background-color: green; padding: 10px;'>Message enregistré</div>";
		// header() fonction nous permettant de rediriger vers une url
		// /!\ cette fonction doit être executée avant le moindre affichage dans la page
		header("location:commentaire.php");
		// echo doit être executé après affichage
		// echo '<script>window.location = "commentaire.php"; </script>';
		}
		else{
			$message_utilisateur = "<div style='color: white; background-color: red; padding: 10px;'>Attention, les champs sont obligatoires!<br>Veuillez recommencer</div>";
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<style>
		* { font-family: calibri; }
		form { width: 25%; min-width: 200px; margin: 0 auto; }
		input { width: 100%; border: 1px solid #dedede; border-radius: 3px; height: 28px; }
	</style>
	<title>Connexion</title>
</head>
	<body>
		<?php
			// echo '<pre>'; print_r($_POST); echo '</pre>';
			echo $message_utilisateur;
		?>
		<form method="post" action="">
			<!-- PSEUDO -->
			<label for="pseudo">Pseudo</label>
			<input type="text" name="pseudo" id="pseudo" />
			<!-- MESSAGE -->
			<label for="message">Commentaire</label>
			<textarea id="message" name="message"></textarea><br /><br />
			<!-- SUBMIT -->
			<input type="submit" id="submit" value="Envoyer" />
		</form>
		<hr>
		<?php
		// récupération des commentaires en BDD
		$liste_commentaires = $pdo->query("SELECT pseudo, message, date_format(date, '%d/%m/%Y à %H:%i:%s') AS date_fr FROM commentaire ORDER BY date DESC");
		echo '<h4>' . $liste_commentaires->rowCount() . 'Commentaire(s)</h4>';
		while($commentaires_en_cours = $liste_commentaires->fetch(PDO::FETCH_ASSOC))
		{
			// echo '<pre>'; print_r($commentaires_en_cours); echo '</pre><hr />';
			echo '<div style="margin-bottom: 5px; border: 1px solid #dedede; padding: 20px; text-align: center; width: 50%; margin: 0 auto;">';
			echo '<div><h3>Par: ' . $commentaires_en_cours['pseudo'] . '<small> le ' . $commentaires_en_cours['date_fr'] . '</small></h3> <hr></div>';
			echo '<div>' . $commentaires_en_cours['message'] . '</div>';
			echo '</div><br />';
		}
		?>
	</body>
</html>