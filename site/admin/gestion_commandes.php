<?php
require("../inc/init.inc.php");

$id_commande = "";
$montant = "";
$date = "";
$etat = "";

$id_article = "";
$titre = "";
$photo = "";
$prix = "";
$quantite = "";

$id_membre = "";
$nom = "";
$prenom = "";
$email = "";
$sexe = "";
$ville = "";
$cp = "";
$adresse = "";


if(!empty($_POST['id_commande']) && isset($_POST['etat']))
{

	$check_commande = $pdo->prepare("UPDATE commande SET etat = :etat WHERE id_commande = :id_commande");
	$check_commande->bindParam(":id_commande", $_POST['id_commande'], PDO::PARAM_STR);
	$check_commande->bindParam(":etat", $_POST['etat'], PDO::PARAM_STR);
	$check_commande->execute();

	// the message
	//$msg = "Le statut de votre commande vient d'être modifié." . $_POST['etat'];

	// send email
	//mail($_POST['email'],"Statut commande",$msg);

}

$liste_commande= $pdo->query("SELECT membre.id_membre, membre.nom, membre.prenom, membre.email, membre.sexe, membre.ville, membre.cp, membre.adresse, commande.id_commande, commande.date, commande.etat, details_commande.id_details_commande, details_commande.quantite, details_commande.prix, commande.montant, article.id_article, article.titre, article.photo FROM article, commande, details_commande, membre WHERE commande.id_commande = details_commande.id_commande AND details_commande.id_article = article.id_article AND commande.id_membre = membre.id_membre ORDER BY id_commande");

// la ligne suivante commence les affichages dans la page
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
//print_r($_POST);
?>
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: blue;"></span> Gestion Commandes <span class="glyphicon glyphicon-user" style="color: plum;"></span></h1>
        <div>
        	<?php
        	$stmt = $pdo->prepare("SELECT SUM(montant) AS value_sum FROM commande");
			$stmt->execute();

			$row = $pdo->fetch(PDO::FETCH_OBJ);
			$sum = $row->value_sum;
        	?>
        </div>
        <?php //echo $message; //messages destinés à l'utilisateur ?>
        <?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>
      </div>
    	<?php
			echo '<div class="row">';
			echo '<div class="col-sm-12">';
			echo '<table class="table table-bordered">';

			echo '<tr>';
			$nb_colonne = $liste_commande->columnCount(); // on récupère le nb de colonnes

			for($i = 0 ; $i < $nb_colonne ; $i++)
			{
				$info_colonne = $liste_commande->getColumnMeta($i);
				// echo '<pre>'; print_r($info_colonne); echo '</pre>';
				echo '<th>' . $info_colonne['name'] . '</th>';
			}
			echo '<th>Modifier</th>';
			echo '</tr>';

			while($article = $liste_commande->fetch(PDO::FETCH_ASSOC))
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
				echo '<td><form method="post" action="">
							<input type="hidden" name="id_commande" value="' . $article['id_commande'] . '" />
							<select name="etat" id="etat">';
				echo '<option value="en cours de traitement">en cours de traitement</option>';
				echo '<option value="envoyé">envoyé</option>';
				echo '<option value="livré">livré</option>';
				echo '</select>
						<button type="submit" name="check" id="check" class="btn btn-primary">Valider</button></form></td>';
				echo '</tr>';
			}

			echo '</table>';
			echo '</div>';
			echo '</div>';
		?>


    </div>

<?php
require("../inc/footer.inc.php");