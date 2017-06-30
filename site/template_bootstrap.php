<?php
require("inc/init.inc.php");

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: blue;"></span> Connexion <span class="glyphicon glyphicon-user" style="color: plum;"></span></h1>
        <?php //echo $message; //messages destinés à l'utilisateur ?>
        <?= $message; //cette balise php inclue un echo // cette ligne php est equivalente à la ligne du dessus ?>
      </div>
    
    </div>

<?php
require("inc/footer.inc.php");