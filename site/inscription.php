<?php
require("inc/init.inc.php");

// déclaration de variables vides pour affichage dans les values du formulaire
$pseudo = "";
$mdp = "";
$nom = "";
$prenom = "";
$email = "";
$sexe = "";
$ville = "";
$cp = "";
$adresse = "";

// controle sur l'existence de tous les champs provenant du formulaire (sauf le bouton de validation)
if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['sexe']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['adresse']))
{
  // si le formulaire a été validé, on place dans ces variables les saisies correspondantes
  $pseudo   = $_POST['pseudo'];
  $mdp      = $_POST['mdp'];
  $nom      = $_POST['nom'];
  $prenom   = $_POST['prenom'];
  $email    = $_POST['email'];
  $sexe     = $_POST['sexe'];
  $ville    = $_POST['ville'];
  $cp       = $_POST['cp'];
  $adresse  = $_POST['adresse'];

  // variable de contrôle des erreurs
  $erreur = "";

  // contrôle sur la taille du pseudo (entre 4 et 14 caractères inclus)
  /*if((iconv_strlen($pseudo) <= 14) && (iconv_strlen($pseudo) >= 4))
  {
    echo 'Le pseudo est valide';
    echo '<br />';
  }
  else{
    echo 'Veuillez entrer un nouveau pseudo ayant entre 4 et 14 caractères compris svp';
    echo '<br />';
  }*/

  $taille_pseudo = iconv_strlen($pseudo);
  if($taille_pseudo < 4 || $taille_pseudo > 14)
  {
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du pseudo est incorrecte.<br />En effet, le pseudo doit avoir entre 4 et 14 caractères inclus</div>';
    $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
  }

  // contrôle des caractères dans le pseudo (autorisés: a-z A-Z 0-9 _ - .)
  $verif_caracteres = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
  /*
  // preg_match() va vérifier les caractères contenus dans la variable pseudo selon une expression régulière fournie en 1er argument
  // renvoie 1 si tout est ok sinon 0

  // expression:
  #   => permet d'indiquer le début et la fin de l'expression
  ^   => indique que la chaine ($pseudo) ne peut que commencer par ces caractères
  $   => indique que la chaine ($pseudo) ne peut que finir par ces caractères
  +   => indique que les caractères autorisés peuvent apparaître plusieurs fois
  []  => contiennent les caractères autorisés
   */
  if(!$verif_caracteres && !empty($pseudo))
  {
    // on rentre dans cette condition si $verif_caracteres contient 0 donc s'il y a des caractères non autorisés
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, caractères non autorisés dans le pseudo<br />Caractères autorisés: A-Z, 0-9, _ , . , - </div>';
    $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
  }

  // contrôle sur la validité du format de l'email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email))
  {
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le format de l\'email n\'est pas respecté!<br />N\'oubliez pas le @ et/ou le .com, .fr, etc..</div>';
    $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
  }

  // controle sur la disponibilité du pseudo en BDD
  $verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
  $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
  $verif_pseudo->execute();

  if($verif_pseudo->rowCount() > 0)
  {
    // si l'on obtient au moins 1 ligne de résultat alors le pseudo est déjà pris
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le pseudo est déjà utilisé!<br />Veuillez entrer un nouveau pseudo</div>';
    $erreur = true;
  }
 
  // insertion dans la BDD
  if($erreur !== true) // si $erreur est différent de true alors les contrôles préalables sont ok
  {
    // pour crypter (hachage) le mdp
    //$mdp = password_hash($mdp, PASSWORD_DEFAULT);
    // pour voir la gestion du mdp lors de la connexion, voir le fichier connexion_avec_mdp_hash.php
    
    $enregistrement = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse, 0)");
    $enregistrement->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $enregistrement->bindParam(":mdp", $mdp, PDO::PARAM_STR);
    $enregistrement->bindParam(":nom", $nom, PDO::PARAM_STR);
    $enregistrement->bindParam(":prenom", $prenom, PDO::PARAM_STR);
    $enregistrement->bindParam(":email", $email, PDO::PARAM_STR);
    $enregistrement->bindParam(":sexe", $sexe, PDO::PARAM_STR);
    $enregistrement->bindParam(":ville", $ville, PDO::PARAM_STR);
    $enregistrement->bindParam(":cp", $cp, PDO::PARAM_STR);
    $enregistrement->bindParam(":adresse", $adresse, PDO::PARAM_STR);
    $enregistrement->execute();
    // on redirige sur la page connexion.php
    header("location:connexion.php");
  }
}

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
echo '<pre>'; print_r($_POST); echo '</pre>';
?>
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: blue;"></span> Inscription <span class="glyphicon glyphicon-user" style="color: plum;"></span></h1>
        <?php echo $message; //messages destinés à l'utilisateur ?>
        <!--<?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>-->
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <form method="POST" action="">
            <div class="form-group">
              <label for="pseudo">Pseudo</label>
              <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php echo $pseudo; ?>">
            </div>
            <div class="form-group">
              <label for="mdp">Mot de passe</label>
              <input type="text" name="mdp" id="mdp" class="form-control" value="<?php echo $mdp; ?>">
            </div>
            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $nom; ?>">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $prenom; ?>">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
              <label for="sexe">Sexe</label>
              <select name="sexe" id="sexe" class="form-control">
                <option value="m">Homme</option>
                <option value="f" <?php if($sexe == 'f') { echo 'selected'; } ?>>Femme</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ville">Ville</label>
              <input type="text" name="ville" id="ville" class="form-control" value="<?php echo $ville; ?>">
            </div>
            <div class="form-group">
              <label for="cp">Code Postal</label>
              <input type="text" name="cp" id="cp" class="form-control" value="<?php echo $cp; ?>">
            </div>
            <div class="form-group">
              <label for="adresse">Adresse</label>
              <textarea name="adresse" id="adresse" class="form-control"><?php echo $adresse; ?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" name="inscription" id="inscription" class="form-control btn btn-success"><span class='glyphicon glyphicon-star-empty' style="color: NavajoWhite;"></span> INSCRIPTION <span class='glyphicon glyphicon-star-empty' style="color: NavajoWhite;"></span></button>
            </div>
          </form>
        </div>
      </div>
    </div><!-- /.container -->

<?php
require("inc/footer.inc.php");