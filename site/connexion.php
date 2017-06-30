<?php
require("inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
  session_destroy();
}

// verification si l'utilisateur est connecté sinon on le redirige sur connexion
if(utilisateur_est_connecte())
{
  header("location:profil.php");
}

if(isset($_POST['pseudo']) && isset($_POST['mdp']))
{
  // vérification de l'existence des indices du formulaire
  $pseudo   = $_POST['pseudo'];
  $mdp      = $_POST['mdp'];

  $verif_connexion = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp");
  $verif_connexion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
  $verif_connexion->bindParam(":mdp", $mdp, PDO::PARAM_STR);
  $verif_connexion->execute();

  if($verif_connexion->rowCount() > 0)
  {
    // pour tester le mdp hash avec la fonction password_hash():
    // si l'on obtient au moins 1 ligne de résultat alors le pseudo est déjà pris
    $info_utilisateur = $verif_connexion->fetch(PDO::FETCH_ASSOC);
    // on place toutes les informations de l'utilisateur dans la session sauf le mdp
    $_SESSION['utilisateur'] = array();
    $_SESSION['utilisateur']['id_membre'] = $info_utilisateur['id_membre'];
    $_SESSION['utilisateur']['pseudo'] = $info_utilisateur['pseudo'];
    $_SESSION['utilisateur']['nom'] = $info_utilisateur['nom'];
    $_SESSION['utilisateur']['prenom'] = $info_utilisateur['prenom'];
    $_SESSION['utilisateur']['email'] = $info_utilisateur['email'];
    $_SESSION['utilisateur']['sexe'] = $info_utilisateur['sexe'];
    $_SESSION['utilisateur']['ville'] = $info_utilisateur['ville'];
    $_SESSION['utilisateur']['cp'] = $info_utilisateur['cp'];
    $_SESSION['utilisateur']['adresse'] = $info_utilisateur['adresse'];
    $_SESSION['utilisateur']['statut'] = $info_utilisateur['statut'];

    // même chose avec un foreach
    /*$_SESSION['utilisateur'] = array();
    foreach($info_utilisateur AS $indice => $valeur)
    {
      if($indice != 'mdp')
      {
        $_SESSION['utilisateur'][$indice] = $valeur;
      }
    }*/
    // on redirige sur la page profil.php
    header("location:profil.php");
  }
  else{
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Le pseudo et/ou le mot de passe n\'est pas valide!<br />Veuillez recommencer</div>';
  }
}

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
//echo '<pre>'; print_r($_SESSION); echo '</pre>';
?>
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: blue;"></span> Connexion <span class="glyphicon glyphicon-user" style="color: plum;"></span></h1>
        <?php //echo $message; //messages destinés à l'utilisateur ?>
        <?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <form method="POST" action="">
            <div class="form-group">
              <label for="pseudo">Pseudo</label>
              <input type="text" name="pseudo" id="pseudo" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="mdp">Mot de passe</label>
              <input type="text" name="mdp" id="mdp" class="form-control" value="">
            </div>
            <div class="form-group">
              <button type="submit" name="connect" id="connect" class="form-control btn btn-success"><span class='glyphicon glyphicon-star-empty' style="color: NavajoWhite;"></span> Se connecter <span class='glyphicon glyphicon-star-empty' style="color: NavajoWhite;"></span></button>
            </div>
          </form>
        </div>
      </div> <!-- fermeture ROW -->

    </div> <!-- fermeture CONTAINER -->

<?php
require("inc/footer.inc.php");