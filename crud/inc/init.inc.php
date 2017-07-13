<?php
// connexion BDD
$pdo = new PDO('mysql:host=localhost;dbname=crud', 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// ouverture de session
session_start();

// déclaration de variable
$content = '';

// inclusions de fichiers
require_once("function.inc.php");
?>