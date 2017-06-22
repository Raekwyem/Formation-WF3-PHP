<?php
// pour voir les fichiers de session => dossier tmp à la racine du serveur (xampp/wamp/mamp/ ...)

// pour créer une session
session_start(); 
// crée une session ou ne fait que l'ouvrir si la session existe déjà
// lors de la création d'une session, un cookie d'identifiant est créé coté utilisateur pour avoir le lien entre la session et l'utilisateur
// comme pour setCookie(), la fonction session_start() doit être exécutée avant le moindre affichage html!

$_SESSION['pseudo'] = "Marie"; // $_SESSION est une superglobale, toutes les superglobales sans exceptions sont des tableaux array. Il est donc possible de créer des indices avec des valeurs dans notre session.
$_SESSION['password'] = "soleil";
$_SESSION['email'] = 'mail@mail.fr';
$_SESSION['age'] = 40;

echo 'Premier affichage de la session: <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';