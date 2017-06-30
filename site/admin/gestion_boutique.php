<?php
require("../inc/init.inc.php");

// restriction d'accès, si l'utilisateur n'est pas admin alors il ne doit pas accéder à cette page
if(!utilisateur_est_admin())
{
	header("location:../connexion.php");
	exit(); // permet d'arrêter l'exécution du script au cas où une personne malveillante ferait des injections via GET
}

// mettre en place un controle pour savoir si l'utilisateur veut une suppression d'un produit
if(isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty(isset($_GET['id_article']) && is_numeric($_GET['id_article'])))
{
	// is_numeric permet de savoir si l'information est bien une valeur numérique sans tenir compte de son type (les informations provenant de GET et de POST sont toujours de type string)
	
	// on fait une requête pour récupérer les informations de l'article afin de connaitre la photo pour la supprimer
	$id_article = $_GET['id_article'];
	$article_a_supprimer = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
	$article_a_supprimer->bindParam(":id_article", $id_article, PDO::PARAM_STR);
	$article_a_supprimer->execute();

	$article_a_suppr = $article_a_supprimer->fetch(PDO::FETCH_ASSOC);

	// on vérifie si la photo existe
	if(!empty($article_a_suppr['photo']))
	{
		// on vérifie le chemin si le fichier existe
		$chemin_photo = RACINE_SERVEUR . 'photo/' . $article_a_suppr['photo'];
		//$message .= $chemin_photo;
		if(file_exists($chemin_photo))
		{
			unlink($chemin_photo); // unlink() permet de supprimer un fichier sur le serveur
		}
	}
	$supprimer = $pdo->prepare("DELETE FROM article WHERE id_article= :id_article");
	$supprimer->bindParam(":id_article", $id_article, PDO::PARAM_STR);
	$supprimer->execute();
	$message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">L\'article numéro ' . $id_article . ' a bien été supprimé</div>';

	// on bascule sur l'affichage du tableau
	$_GET['action'] = 'affichage';
}

// déclaration de variables vides pour affichage dans les values du formulaire
$id_article = "";
$reference = "";
$categorie = "";
$titre = "";
$description = "";
$couleur = "";
$taille = "";
$sexe = "";
$photo_bdd = "";
$prix = "";
$stock = "";

// variable de contrôle des erreurs
$erreur = "";

// RECUPERATION DES INFORMATIONS D'UN ARTICLE A MODIFIER
if(isset($_GET['action']) && $_GET['action'] == 'modification' && !empty(isset($_GET['id_article']) && is_numeric($_GET['id_article'])))
{
	$id_article = $_GET['id_article'];
	$article_a_modif = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
	$article_a_modif->bindParam(":id_article", $id_article, PDO::PARAM_STR);
	$article_a_modif->execute();
	$article_actuel = $article_a_modif->fetch(PDO::FETCH_ASSOC);

	$id_article		= $article_actuel['id_article'];
  	$reference   	= $article_actuel['reference'];
  	$categorie   	= $article_actuel['categorie'];
  	$titre      	= $article_actuel['titre'];
  	$description  	= $article_actuel['description'];
  	$couleur    	= $article_actuel['couleur'];
  	$taille     	= $article_actuel['taille'];
  	$sexe    		= $article_actuel['sexe'];
  	$prix  			= $article_actuel['prix'];
  	$stock  		= $article_actuel['stock'];
  	// on récupère la photo de l'article dans une nouvelle variable
  	$photo_actuelle = $article_actuel['photo'];
}

// controle sur l'existence de tous les champs provenant du formulaire (sauf le bouton de validation)
if(isset($_POST['id_article']) && isset($_POST['reference']) && isset($_POST['categorie']) && isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['couleur']) && isset($_POST['taille']) && isset($_POST['sexe']) && isset($_POST['prix']) && isset($_POST['stock']))
{
  // si le formulaire a été validé, on place dans ces variables les saisies correspondantes
  $id_article	= $_POST['id_article'];
  $reference   	= $_POST['reference'];
  $categorie   	= $_POST['categorie'];
  $titre      	= $_POST['titre'];
  $description  = $_POST['description'];
  $couleur    	= $_POST['couleur'];
  $taille     	= $_POST['taille'];
  $sexe    		= $_POST['sexe'];
  $prix  		= $_POST['prix'];
  $stock  		= $_POST['stock'];

  // controle sur la disponibilité du pseudo en BDD si on est dans le cas d'un ajour car lors de la modification la référence existera toujours
  $verif_reference = $pdo->prepare("SELECT * FROM article WHERE reference = :reference");
  $verif_reference->bindParam(":reference", $reference, PDO::PARAM_STR);
  $verif_reference->execute();

  if($verif_reference->rowCount() > 0 && isset($_GET['action']) && $_GET['action'] == 'ajout')
  {
    // si l'on obtient au moins 1 ligne de résultat alors la référence est déjà existante
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la référence existe déjà!<br />Veuillez vérifier vos données</div>';
    $erreur = true;
  }

  if(empty($titre))
  {
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, aucun titre n\'a été entré!<br />Veuillez entrer un titre</div>';
    $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
  }

  // récupértion de l'ancienne photo dans le cas d'une modification
  if(isset($_GET['action']) && $_GET['action'] == "modifiction")
  {
  	if(isset($_POST['ancienne_photo']))
  	{
  		$photo_bdd = $_POST['ancienne_photo'];
  	}
  }

  // vérification si l'utilisateur a chargé une image
  if(!empty($_FILES['photo']['name']))
  {
  	// si ce n'est pas vide alors un fichier a bien été chargé via le formulaire
  	
  	// on concatène la référence sur le titre afin de ne jamais avoir un fichier avec un nom déjà existant sur le serveur
  	$photo_bdd = $reference . $_FILES['photo']['name'];

  	// vérification de l'extension de l'image (extension acceptées: jpg, jpeg, png, gif)
  	$extension = strrchr($_FILES['photo']['name'], '.'); // cette fonction prédéfinie permet de découper une chaine selon un caractère fourni en 2eme argument (ici le .). Attention, cette fonction découpera la chaine à partir de la dernière occurence du 2eme argument (donc nous renvoie la chaine comprise après le dernier point trouvé)
  	// ex: maphot.jpg => on récupère .jpg
  	// ex: maphoto.photo.png => on récupère .png
  	// var_dump($extension);
  	
  	// on transforme $extension afin que tous les caractères soient en minuscule
  	$extension = strtolower($extension); // inverse strtoupper()
  	// on enlève le .
  	$extension = substr($extension, 1); // exemple: .jpg => jpg
  	// les extensions acceptées
  	$tab_extension_valide = array("jpg", "jpeg", "png", "gif");
  	// nous pouvons donc vérifier si $extension fait partie des valeurs autorisées dans $tab_extension_valide
  	$verif_extension = in_array($extension, $tab_extension_valide); // in_array vérifie si une valeur fournie en 1er argument fait partie des valeurs contenues dans un tableau array fourni en 2eme argument

  	if($verif_extension && !$erreur)
  	{
  		// si $verif_extension est égal à true et que $erreur n'est pas égal à true (il n'y a pas eu d'erreur au préalable)
  		$photo_dossier = RACINE_SERVEUR . 'photo/' . $photo_bdd;

  		copy($_FILES['photo']['tmp_name'], $photo_dossier);
  		// copy() permet de copier un fichier depuis un emplacement fourni en premier argument vers un autre emplacement fourni en 2eme argument
  	}
  	elseif(!$verif_extension){
  		$message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la photo n\' a pas une extension valide (extensions acceptées: jpg / jpeg / png / gif)</div>';
  		$erreur = true;
  	}
  }

  if($erreur !== true) // si $erreur est différent de true alors les contrôles préalables sont ok
  {

  	if(isset($_GET['action']) && $_GET['action'] == 'ajout')
  	{
  	// insertion dans la BDD
    $ajout = $pdo->prepare("INSERT INTO article (reference, categorie, titre, description, couleur, taille, sexe, prix, stock, photo) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :sexe, :prix, :stock, :photo)");
	}
	elseif (isset($_GET['action']) && $_GET['action'] == 'modification') {
		$ajout = $pdo->prepare("UPDATE article SET reference = :reference, categorie = :categorie, titre = :titre, description = :description, couleur = :couleur, taille = :taille, sexe = :sexe, prix = :prix, stock = :stock, photo = :photo WHERE id_article = :id_article");
		$id_article = $_POST['id_article'];
		$ajout->bindParam(":id_article", $id_article, PDO::PARAM_STR);
	}

    $ajout->bindParam(":reference", $reference, PDO::PARAM_STR);
    $ajout->bindParam(":categorie", $categorie, PDO::PARAM_STR);
    $ajout->bindParam(":titre", $titre, PDO::PARAM_STR);
    $ajout->bindParam(":description", $description, PDO::PARAM_STR);
    $ajout->bindParam(":couleur", $couleur, PDO::PARAM_STR);
    $ajout->bindParam(":taille", $taille, PDO::PARAM_STR);
    $ajout->bindParam(":sexe", $sexe, PDO::PARAM_STR);
    $ajout->bindParam(":prix", $prix, PDO::PARAM_STR);
    $ajout->bindParam(":stock", $stock, PDO::PARAM_STR);
    $ajout->bindParam(":photo", $photo_bdd, PDO::PARAM_STR);
    $ajout->execute();
  }
}

// la ligne suivante commence les affichages dans la page
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
echo '<pre>'; print_r($_POST); echo '</pre>';
echo '<pre>'; print_r($_FILES); echo '</pre>';
?>
    <div class="container">

      	<div class="starter-template">
        	<h1><span class="glyphicon glyphicon-shopping-cart" style="color: blue;"></span> Gestion Boutique <span class="glyphicon glyphicon-shopping-cart" style="color: blue;"></span></h1>
        	<?php //echo $message; //messages destinés à l'utilisateur ?>
        	<?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>
        	<hr />
        	<a href="?action=ajout" class="btn btn-warning">Ajouter un produit</a>
        	<a href="?action=affichage" class="btn btn-info">Afficher les produits</a>
      	</div>

		<?php
		if(isset($_GET['action']) && $_GET['action'] == 'affichage')
		{
			$resultat = $pdo->query("SELECT * FROM article");
			echo '<hr>';

			echo '<div class="row">';
			echo '<div class="col-sm-12">';
			echo '<table class="table table-bordered">';

			echo '<tr>';
			$nb_colonne = $resultat->columnCount(); // on récupère le nb de colonnes

			for($i = 0 ; $i < $nb_colonne ; $i++)
			{
				$info_colonne = $resultat->getColumnMeta($i);
				// echo '<pre>'; print_r($info_colonne); echo '</pre>';
				echo '<th>' . $info_colonne['name'] . '</th>';
			}
			echo '<th>Modifier</th>';
			echo '<th>Supprimer</th>';
			echo '</tr>';

			while($article = $resultat->fetch(PDO::FETCH_ASSOC))
			{
				echo '<tr>';
				foreach ($article AS $indice => $valeur)
				{
					if($indice == 'photo')
					{
						echo '<td><img src="' . URL . 'photo/' . $valeur . '" class="img-thumbnail"></td>';
					}
					elseif($indice == "description")
					{
						echo '<td>' . substr($valeur, 0, 56) . '...</td>';
					}
					elseif($indice == "prix")
					{
						echo '<td><span style="color: red;">' . $valeur . '€</span></td>';
					}
					else
					{
					echo '<td>' . $valeur . '</td>';
					}
				}
				echo '<td><a href="?action=modification&id_article=' . $article['id_article'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span></a></td>';

				echo '<td><a onclick="return(confirm(\'Etes Vous sûr\'));" href="?action=suppression&id_article=' . $article['id_article'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>';
				echo '</tr>';
			}

			echo '</table>';
			echo '</div>';
			echo '</div>';

		}
		?>
		<!--
      	<?php
      	// affichage de tous les produits dans un tableau html
      	// ex: couper la description si elle est trop longue
      	// ex: afficher l'image dans une balise <img src="" />
      	if(isset($_GET['action']) && $_GET['action'] == 'affichage'){
      	?>
		<div class="container">
		  	<h2>Tous les produits</h2>
         
		  	<table class="table table-hover">
		    	<thead>
		      		<tr>
		        		<th>id_article</th>
		        		<th>Référence</th>
		        		<th>Titre</th>
		        		<th>Catégorie</th>
		        		<th>Description</th>
		        		<th>Photo</th>
		        		<th>Sexe</th>
		        		<th>Taille</th>
		        		<th>Couleur</th>
		        		<th>Stock</th>
		        		<th>Prix</th>
		      		</tr>
		    	</thead>
		    	<tbody>
		      		<tr>
		        		<td>John</td>
		        		<td>Doe</td>
		        		<td>john@example.com</td>
		      		</tr>
		      		<tr>
				        <td>Mary</td>
				        <td>Moe</td>
				        <td>mary@example.com</td>
		      		</tr>
		      		<tr>
				        <td>July</td>
				        <td>Dooley</td>
				        <td>july@example.com</td>
		      		</tr>
		    	</tbody>
		  	</table>
		</div>
      	<?php }
    	?>-->
		<?php if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')){ ?>

    	<div class="row">
        	<div class="col-sm-4 col-sm-offset-4">
          		<form method="post" action="" enctype="multipart/form-data">
          			<p style="color: red;">* (champ(s) obligatoire(s))</p>
          			<input type="hidden" name="id_article" id="id_article" class="form-control" value="<?php echo $id_article; ?>">
		            <div class="form-group">
		              	<label for="reference">Référence<span style="color: red;">*</span></label>
		              	<input type="text" name="reference" id="reference" class="form-control" value="<?php echo $reference; ?>"></input>
		            </div>
		            <div class="form-group">
		              	<label for="titre">Titre<span style="color: red;">*</span></label>
		              	<input type="text" name="titre" id="titre" class="form-control" value="<?php echo $titre; ?>">
		            </div>
		            <div class="form-group">
		              	<label for="categorie">Catégorie</label>
		              	<select name="categorie" id="categorie" class="form-control">
		                	<option <?php if($categorie == "T-Shirt") { echo 'selected'; } ?>>T-Shirt</option>
		                	<option <?php if($categorie == "Chemise") { echo 'selected'; } ?>>Chemise</option>
		                	<option <?php if($categorie == "Pantalon") { echo 'selected'; } ?>>Pantalon</option>
		                	<option <?php if($categorie == "Veste") { echo 'selected'; } ?>>Veste</option>
		              	</select>
		            </div>
		            <div class="form-group">
		              	<label for="description">Description</label>
		              	<textarea name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
		            </div>

					<?php
					// affichage de la photo actuelle dans le cas d'une modification d'article
						if(isset($article_actuel)) // si cette variable existe alors nous sommes dans le cas d'une modification
						{
							echo '<div class="form-group">';
							echo '<label>Photo actuelle</label><br>';
							echo '<img src="' . URL . 'photo/' . $photo_actuelle . '" class="img-thumbnail" width="210">';
							// on crée un champ caché qui contiendra la nom de la photo afin de le récupérer lors de la validation du formulaire
							echo '<input type="hidden" name="ancienne_photo" value="' . $photo_actuelle . '">';
							echo '</div>';
						}
					?>

		            <div class="form-group">
		              	<label for="photo">Photo</label>
		              	<input type="file" name="photo" id="photo" class="form-control">
		            </div>
		            <div class="form-group">
		              	<label for="sexe">Sexe</label>
		              	<select name="sexe" id="sexe" class="form-control">
		                	<option value="m">Homme</option>
		                	<option value="f" <?php if($sexe == 'f') { echo 'selected'; } ?>>Femme</option>
		              	</select>
		            </div>
		            <div class="form-group">
		              	<label for="taille">Taille</label>
		              	<select name="taille" id="taille" class="form-control">
		                	<option>XS</option>
		                	<option <?php if($taille == 'S') { echo 'selected'; } ?>>S</option>
		                	<option <?php if($taille == 'M') { echo 'selected'; } ?>>M</option>
		                	<option <?php if($taille == 'L') { echo 'selected'; } ?>>L</option>
		                	<option <?php if($taille == 'XL') { echo 'selected'; } ?>>XL</option>
		              	</select>
		            </div>
		            <div class="form-group">
		              	<label for="couleur">Couleur</label>
		              	<select name="couleur" id="couleur" class="form-control">
		                	<option>Blanc</option>
		                	<option <?php if($categorie == "Noir") { echo 'selected'; } ?>>Noir</option>
		                	<option <?php if($categorie == "Bleu") { echo 'selected'; } ?>>Bleu</option>
		                	<option <?php if($categorie == "Gris") { echo 'selected'; } ?>>Gris</option>
		                	<option <?php if($categorie == "Rose") { echo 'selected'; } ?>>Rose</option>
		                	<option <?php if($categorie == "Vert") { echo 'selected'; } ?>>Vert</option>
		                	<option <?php if($categorie == "Jaune") { echo 'selected'; } ?>>Jaune</option>
		              	</select>
		            </div>
		            <div class="form-group">
		              	<label for="stock">Stock<span style="color: red;">*</span></label>
		              	<input type="text" name="stock" id="stock" class="form-control" value="<?php echo $stock; ?>">
		            </div>
		            <div class="form-group">
		              	<label for="prix">Prix<span style="color: red;">*</span></label>
		              	<input type="text" name="prix" id="prix" class="form-control" value="<?php echo $prix; ?>"></input>
		            </div>
		            <div class="form-group">
		              	<button type="submit" name="ajouter" id="ajouter" class="form-control btn btn-primary"><span class='glyphicon glyphicon-star-empty' style="color: NavajoWhite;"></span> AJOUTER <span class='glyphicon glyphicon-star-empty' style="color: NavajoWhite;"></span></button>
		            </div>
          		</form>
        	</div> <!-- FERMETURE COL -->
      	</div> <!-- FERMETURE ROW -->
		<?php } ?> <!-- FERMETURE CONDITION BOUTON -->
    </div> <!-- FERMETURE CONTAINER -->

<?php
require("../inc/footer.inc.php");