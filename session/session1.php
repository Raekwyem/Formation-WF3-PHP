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
$_SESSION['adresse']['code postal'] = 75000;
$_SESSION['adresse']['ville'] = 'Paris';
$_SESSION['adresse']['adresse'] = 'rue du tertre'

echo 'Premier affichage de la session: <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';

// pour supprimer un élément de la session: unset()
unset ($_SESSION['password']);

echo 'Deuxième affichage de la session: <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';

// pour détruire la session
session_destroy(); // permet se supprimer la session,en revanche, il faut savoir que l'information session_destroy() est vu par l'interpréteur php, mise de coté puis exécutée uniquement à la fin du scipt en cours

echo 'Troisième affichage de la session: <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';