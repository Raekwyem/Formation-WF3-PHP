<?php
require("inc/init.inc.php");

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>
    <div class="container">

      	<div class="starter-template">
        	<h1><span class="glyphicon glyphicon-user" style="color: blue;"></span> Boutique <span class="glyphicon glyphicon-user" style="color: plum;"></span></h1>
        	<?php //echo $message; //messages destinés à l'utilisateur ?>
        	<?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>
      	</div>

		<div class="row">
			<div class="col-sm-2">
				<?php // récupérer toutes les catégories en BDD et les afficher dans une liste ul li sous forme de lien a href avec une information GET par exemple:?categorie=pantalon 
				// requete de récupération des différentes catégories en BDD
				$liste_categorie = $pdo->query("SELECT DISTINCT categorie FROM article");
				echo '<ul class="list-group">';
				while($categorie = $liste_categorie->fetch(PDO::FETCH_ASSOC))
				{
					echo '<li class="list-group-item"><a href="?categorie=' . $categorie['categorie'] . '">' . $categorie['categorie'] . '</a></li>';
				}
				echo '</ul>';
				?>

			</div>
			<div class="col-sm-10">
				<?php //afficher tous les produits dans cette page par exemple: un block avec image + titre + prix produit 
				
				$liste_article = $pdo->query("SELECT * FROM article");
				echo '<div class="row">';
				while($article = $liste_article->fetch(PDO::FETCH_ASSOC))
				{
					echo '<div class="col-sm-3">';
					echo '<div class="panel panel-default">';
					echo '<div class="panel-heading"><img src="' . URL . 'img/logo-boutique.gif" class="img-responsive" /></div>';
					echo '<div class="panel-body">';
					echo '<img src="' . URL . 'photo/' . $article['photo'] . '" class="img-responsive" />';
					echo '</div></div></div>';
				}
				?>
			</div>
		</div>
    
    </div>

<?php
require("inc/footer.inc.php");