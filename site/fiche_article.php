<?php
require("inc/init.inc.php");

// on vérifie si l'indice id_article existe dans GET ou s'il n'est pas vide, || on test aussi si la valeur est bien un chiffre
if(empty($_GET['id_article']) || !is_numeric($_GET['id_article']))
{
	header("location:boutique.php");
}

$id_article = $_GET['id_article'];
$recup_article = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
$recup_article->bindParam(":id_article", $id_article, PDO::PARAM_STR);
$recup_article->execute();

// vérification si l'on a bien récupéré un article ou si nous avons une réponse vide (ex: changement d'id_article dans l'url par l'utilisateur)
if($recup_article->rowCount() < 1)
{
	// s'il y a moins d'une ligne alors la réponse de la BDD est vide donc on redirige vers l'accueil
	header("location:boutique.php");
}

$article = $recup_article->fetch(PDO::FETCH_ASSOC);

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
echo '<pre>'; print_r($article); echo '</pre>';

// dans cette page, affichez les informations de l'article sauf le stock
// mettre également en place un lien retour vers votre sélection sur la boutique
?>
    <div class="container">

      	<div class="starter-template">
        	<h1><span class="glyphicon glyphicon-user" style="color: blue;"></span> Fiche Article <span class="glyphicon glyphicon-user" style="color: plum;"></span></h1>
        	<?php //echo $message; //messages destinés à l'utilisateur ?>
        	<?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>
      	</div>

      	<div class="col-md-12">
      		<?php
      		echo '<img src="' . URL . 'photo/' . $article['photo'] . '" class="img-responsive" />';
      		?>
      	</div>
    	
    	<div class="col-md-12">
    		<?php
    			echo '<hr><p>' . $article['description'] . '<p>';
    			echo '<hr>';

    			if($article['stock'] > 0)
    			{
    			// formulaire d'ajout au panier
    			echo '<form method="post" action="panier.php">';

    			// on récupère l'id_article dans un champs caché afin de savoir ensuite quel est le produit qui a été ajouté
    			echo '<input type="hidden" name="id_article" value="' . $article['id_article'] . '">';

    			// faire un champ select pour le choix de la quantité selon la quantité disponible du produit avec une sécurité pour afficher maximum 7 si la quantité est supérieure (2ème condition d'entrée dans la boucle ($i<8))
    			echo '<select name="quantite" class="form-control">';

    			for($i = 1; $i <= $article['stock'] && $i < 8; $i++)
    			{
    				echo '<option>' . $i . '</option>';
    			}
    			echo '</select><br>';

    			echo '<input type="submit" name="ajout_panier" value="Ajouter au panier" class="form-control btn btn-warning">';

    			echo '</form>';
    			}
    			else {
    				echo '<h3>Rupture de stock pour ce produit</h3>';
    			}
    			echo '<hr>';
    			echo '<a href="boutique.php?categorie=' . $article['categorie'] . '" class="btn btn-success form-control">Retour vers votre sélection</a>';
    		?>
    	</div>

    </div>

<?php
require("inc/footer.inc.php");