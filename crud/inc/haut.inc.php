<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>CRUD</title>
        <link href="<?php echo URL; ?>photo/fav.png" rel="icon">
        <!-- Bootstrap core CSS -->
        <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""> CRUD </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo URL; ?>boutique.php">Accueil</a></li>
                        <li><a href="<?php echo URL; ?>panier.php">Panier</a></li>
                        <li><a href="<?php echo URL; ?>inscription.php">Inscription</a></li>
                        <li><a href="<?php echo URL; ?>connexion.php">Connexion</a></li>
                        <li><a href="<?php echo URL; ?>profil.php">Profil</a></li>
                        <li><a href="<?php echo URL; ?>connexion.php?action=deconnexion">Déconnexion</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
        <script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>js/script.js"></script>