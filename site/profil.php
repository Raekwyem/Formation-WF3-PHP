<?php
require("inc/init.inc.php");

// verification si l'utilisateur est connecté sinon on le redirige sur connexion
if(!utilisateur_est_connecte())
{
	header("location:connexion.php");
}

$statut = $_SESSION['utilisateur']['statut'];
if($statut == 1)
{
	$role = "Admin";
}
else{
	$role = "Membre";
}

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>
    <div class="container">

    	<div class="starter-template">
        	<h1><span class="glyphicon glyphicon-user" style="color: blue;"></span> Profil (<?php echo $role; ?>) <span class="glyphicon glyphicon-user" style="color: plum;"></span></h1>
        	<?php //echo $message; //messages destinés à l'utilisateur ?>
        	<?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>
      	</div>
      	<h1 style="background-color: green; color: white; padding: 10px;"><?php echo $_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom'] ?> aka <span style="color: yellow;"><?php echo $_SESSION['utilisateur']['pseudo'] ?></span></h1>

      	<?php
			echo '<b>Sexe:</b>' . $_SESSION['utilisateur']['sexe'] . '<br />';
			echo '<b>Email:</b>' . $_SESSION['utilisateur']['email'] . '<br />';
			echo '<b>Adresse:</b>' . $_SESSION['utilisateur']['adresse'] . '<br />';
			echo '<b>Code Postal:</b>' . $_SESSION['utilisateur']['cp'] . '<br />';
			echo '<b>Ville:</b>' . $_SESSION['utilisateur']['ville'] . '<br />';
      	?>
    </div>

<?php
require("inc/footer.inc.php");