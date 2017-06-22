<style>
	* { font-family: sans-serif; }
	h3 { padding: 10px; background-color: darkred; color: white; }
</style>
<?php
// sur page1.php et page2.php mettre un titre avec le nom de la page et un lien qui permet de passer d'une page vers l'autre
echo '<h3>Page 2</h3>';
echo '<a href="page1.php">Aller sur la page 1</a>';

// Pour récupérer une ou des informations depuis l'url, nous pouvons utiliser le protocole HTTP GET
// en php nous utilisons la superglobale $_GET
// UNE superglobale est disponible dans tous les environnements, notamment dans une fonction sans avoir besoin de l'appeler avec le mot clé "global"
// TOUTES les superglobales sont des tableaux ARRAY

// dans l'url le "?" précise que l'url est finie, tout ce qui se trouve après le ? sont des informations que nous retrouverons dans $_GET
// syntaxe:
// ?indice1=valeur1&indice2=valeur2&indice3=valeur3 etc...
 echo '<pre>'; print_r($_GET); echo '</pre>';

// /!\ $_GET & $_POST sont toujours existantes !
// si je fais: if(isset($_GET)) la réponse sera systématiquement "vrai"
if(isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET['prix']))
{
echo 'L\'article est un ' . $_GET['article'] . ' de couleur ' . $_GET['couleur'] . ' et son prix est de ' . $_GET['prix'] . ' euros.';
}