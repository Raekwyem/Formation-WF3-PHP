<style>
* { font-family: calibri; }
h1 { padding: 10px; color: white; background-color: darkslategray; }
</style>
<h1>Ecriture et affichage</h1>
<!-- tout d'abord, il est possible d'écrire du html dans un fichier .php, en revanche l'inverse n'est pas possible -->
<?php // balise php ouverture et fermeture ?>
<?php
// instruction d'affichage
// variable: types / déclaration / affectation
// Concaténation
// guillemets et quotes
// constante
// condition et opérateurs de comparaison
// fonction prédéfinie
// fonction utilisateur
// boucle
// inclusion
// array
// classe et objet.

echo 'Bonjour'; // echo est une instruction permettant d'effecteur un affichage.
echo '<br />'; // il est possible de mettre du html 
echo 'Bienvenue<br />'; // si vous regardez le code source, il n'est pas possible de voir le code php car déjà interprété depuis le serveur.
print 'Print est une autre instruction d\'affichage similaire à echo<br />';

  
// les commentaires en PHP
// ceci est un commentaire sur une seule ligne.
# ceci est un commentaire sur une seule ligne.
/*
Ceci est un commentaire sur
plusieurs
lignes
*/
// autres instructions d'affichage mais spécifiques aux phases de developpement: print_r() & var_dump()

echo '<h1>Variables: types / déclaration / affectation</h1>';
// définition: une variable est un espace nommé permettant de conserver une valeur.

// déclaration d'une variable avec le signe $ // une variable est sensible à la casse // caractères autorisés: de a z, de 0  9 et le _ // /!\ une variable ne peut pas commencer par un chiffre.

// affectation d'une valeur avec le signe =
$a = 127;
echo gettype($a); // integer
echo '<br />';

$b = 1.5;
echo gettype($b); // double
echo '<br />';

$a = 'Une chaine';
echo gettype($a); // string
echo '<br />';

$b = '127';
echo gettype($b); // string
echo '<br />';

$a = true; // ou TRUE // ou l'inverse false / FALSE
echo gettype($a); // bool
echo '<br />';

echo '<h1>Concaténation</h1>';
// en php nous utiliserons le . pour la concaténation que l'on peut traduire par "suivi de"
$x = "Bonjour ";
$y = "tout le monde";
echo $x . ' ' . $y . '<br />';

echo "<br />" , 'Coucou' , '<br />'; // il est possible de faire la concaténation avec une , en revanche uniquement avec echo. (erreur avec print)

echo '<h1>Concaténation lors de l\'affectation</h1>';
$prenom1 = "Bruno ";
$prenom1 = "claire";

echo $prenom1 . '<br />'; // affiche claire

$prenom2 = "Bruno ";
$prenom2 .= "claire"; // équivalent à écrire $prenom2 = $prenom2 . 'claire';
// le .= permet de rajouter à l'existant sans l'écraser.
echo $prenom2 . '<br />';

echo '<h1>Guillemets & Quotes</h1>';

$message = "Aujourd'hui";
// ou 
$message = 'Aujourd\'hui';

// concaténation:
echo $message . ' il fait chaud<br />';
echo "$message il fait chaud<br />"; // dans des guillemets, les variables sont reconnues et donc interprétées.
echo '$message il fait chaud<br />'; // dans des quotes, les variables ne sont pas reconnues et donc interprétées comme du texte.

echo '<h1>Les constantes & constantes magiques</h1>';
// une constante est un peu comme une variable un espace nommé nous permettant de conserver une valeur sauf que comme son nom l'indique, cette valeur ne pourra pas changer durant l'exécution du script.
define("CAPITALE", "Paris"); // 1er argument: le nom de la constante / 2eme argument: sa valeur.
// Par convention, une constante s'écrit toujours en majuscule.
echo CAPITALE . '<br />';

// constante magique.
echo __FILE__ . '<br />'; // affiche le chemin complet jusqu'à ce fichier.
echo __LINE__ . '<br />'; // affiche le numéro de la ligne

echo '<h1>Exercice sur les variables</h1>';
// mettre les valeurs "lundi" "mardi" et "mercredi" dans 3 variables.
// Afficher "lundi - mardi - mercredi" en appelant les variables.
$jour1 = 'lundi';
$jour2 = 'mardi';
$jour3 = 'mercredi';
$sep = " - ";

echo $jour1 . " - " . $jour2 . ' - '. $jour3 . '<br />';
echo $jour1 . $sep . $jour2 . $sep . $jour3 . '<br />';
echo "$jour1 - $jour2 - $jour3";

echo '<h1>Opérateurs arithmétique</h1>';
$a = 10; $b = 2;
echo $a + $b . '<br />'; // affiche 12
echo $a - $b . '<br />'; // affiche 8
echo $a * $b . '<br />'; // affiche 20
echo $a / $b . '<br />'; // affiche 5
echo $a % $b . '<br />'; // modulo => affiche 0 (le restant de la division)

// facilité d'écriture:
echo $a += $b; // équivaut à $a = $a + $b
// $a -= $b
// $a *= $b
// $a /= $b


echo '<h1>Structures conditionelles (if / elseif / else) et opérateurs de comparaison</h1>';
// isset - empty

// isset test si l'élément existe (s'il a été déclaré au préalable dans notre script par exemple)
// empty test si l'élément est vide (à savoir, empty vérifie au préablable si l'élément est défini avant de tester s'il est vide.)

$var1 = 0; // ou $var1 = ""; $var1 = false;

if(empty($var1)) 
{
	echo 'la variable var1 est vide ou non définie<br />';
}	


$var2 = "";
if(isset($var2))
{
	echo "La variable var2 existe ! <br />";
}

// opérateurs de comparaison
$a = 10; $b = 5; $c = 2;

if($a > $b) // si "a" est strictement supérieur à "b"
{
	print "'a' est bien supérieur à 'b'<br />";
}
else { // sinon => toutes les autres possibilités
	print "'a' n'est pas supérieur à 'b'<br />";
}

// ET
if($a > $b && $b > $c) // si "a" est supérieur à "b" ET DANS LE MEME TEMPS si "b" est supéieur à "c"
{
	echo 'Ok pour les deux conditions<br />';
}

// OU
if($a == 9 || $b > $c) // si "a" est égal à 9 OU si "b" est supérieur à "c"
{
	echo 'Ok pour au moins une des deux conditions<br />';
}

// XOR 
if($a == 10 XOR $b < $c) // avec XOR on ne rentre dans la condition que si l'une des deux conditions est vrai. Si les deux conditons sont vrais on ne rentre pas
{
	echo 'Ok pour une seule des deux conditions (condition exclusive)<br />';
}
// Avec XOR:
// true XOR true => false
// false XOR false => false
// true XOR false => true
// false XOR true => true

if($a == 8)
{
	print 'réponse 1<br />';
}
elseif($a != 10)
{
	print 'réponse 2<br />';
}
else {
	echo 'réponse 3<br />';
}

$a1 = 1;
$a2 = '1';

if($a1 == $a2)
{
	echo 'C\'est la même chose<br />';
}
if($a1 === $a2)
{
	echo 'C\'est la même chose<br />';
}
/*
	=		Affectation
	==		Comparaison des valeurs
	===		Comparaison des valeurs & de types
	!=		différent de (en terme de valeur)
	!==		différent de (en terme de valeur ou de type)
	> 		strictement supérieur
	< 		strictement inférieur
	>=		supérieur ou égal
	<=		inférieur ou égal
*/

// forme contractée des if: autre écriture
echo ($a == 10) ? 'if en forme contractée<br />' : 'else en forme contractée<br />';
// le ? représente le if
// les : représentent le else
	
echo '<h1>Condition switch</h1>';
// les cases représentent des cas différents dans lesquel nous pouvont potentiellement rentrer.
$couleur = 'jaune';
switch($couleur)
{
	case 'bleu':
		echo 'Vous aimez le bleu<br />';
	break;
	case 'rouge':
		echo 'Vous aimez le rouge<br />';
	break;
	case 'vert':
		echo 'Vous aimez le vert<br />';
	break;
	default: // toutes les autres possibilités
		echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert<br />';
	break;
}

// EXERCICE: refaire la condition précédente avec if / elseif / else
$couleur = 'jaune';
if($couleur == 'bleu')
{
	echo 'Vous aimez le bleu<br />';
}
elseif($couleur == "rouge")
{
	echo 'Vous aimez le rouge<br />';
}
elseif($couleur == "vert")
{
	echo 'Vous aimez le vert<br />';
}
else {
	echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert<br />';
}

echo '<h1>Fonction prédéfinie</h1>';
// une fonction prédéfinie est déjà inscrite dans le langage, le developpeur ne fait que l'exécuter.
echo 'Date du jour:<br />';
echo date("d/m/Y H:i:s");
// date est une fonction prédéfinie permettant d'afficher la date.
// en argument cette fonction accepte une chaine de caractère.
// Selon les caractères fournis, cette fonction nous renvoie différent format de date.
// voir la doc pour les formats disponibles: http://php.net/manual/fr/function.date.php

echo '<hr />' . time() . '<hr />'; // time() nous affiche le timestamp (nb de seconde s ecoulées depuis le 1er janvier 1970)

// traitement des chaines (iconv_strlen() / strpos() / substr())
$email = 'mathieuquittard@evogue.fr';
echo strpos($email, '@') . '<br />';
// strpos permet de chercher dans une chaine (fournie en 1er argument) une autre chaine (fournie en 2eme argument)
// /!\ dans une chaine le premier caractère a la position 0

// valeur de retour
	// Succes => on obtient un int (la position)
	// Echec  => booleen false

$email2 = "rljgrlezjg";
echo strpos($email2, '@') . '<br />';	
var_dump(strpos($email2, '@')); // var_dump() est une instruction d'affichage ameliorée nous affichant la valeur de ce que l'on test + son type et si le type est string on obtient également sa longueur.
// ici var_dump() nous permet de voir le false obtenu via la fonction strpos()

// iconv_strlen
$phrase = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
echo '<br />';
echo iconv_strlen($phrase) . '<br />';
// iconv_strlen permet de compter le nombre de caractère dans une chaine.
// valeur de retour en cas de succes => int (la longueur de la chaine)	
	
// substr
$texte = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis tincidunt lorem. Phasellus mollis consectetur ligula, sit amet ultricies neque dapibus a. Duis sit amet vulputate lectus. Aliquam sollicitudin volutpat ante, vitae accumsan ligula blandit eget.";	
	
echo substr($texte, 0, 35) . " ...<a href='#'>Lire la suite</a>";
// substr permet de découper une chaine
	// 1er argument => la chaine a découper
	// 2eme argument=> la position de depart
	// 3eme argument=> le nombre de caractères à renvoyer. (cet argument est facultatif, s'il n'est pas présent on récupère tout depis la position de départ)
	

echo '<h1>Fonction utilisateur</h1>';
// non inscrite au langage, c'est le developpeur qui les déclare puis les exécute.

// déclaration d'une fonction
function separation()
{
	echo '<hr /><hr /><hr />';
}

// execution:
separation();	
	
	
// fonction avec 1 argument
function bonjour($qui)
{
	return "Bonjour " . $qui . '<br />';
}
// une return nous renvoie le resultat de cette fonction en revanche si l'on veut faire un affichage il faudra passer par un echo	
echo bonjour('Mathieu');	
$prenom = "Marie";
echo bonjour($prenom);

// fonction pour appliquer la tva
function applique_tva($nombre)
{
	return $nombre * 1.2;
}
echo applique_tva(1000) . '<br />';

// EXERCICE: refaire la fonction précédente en donnant la possibilité à l'utilisateur de choisir le taux. (que ce ne soit pas figé sur le taux 1.2)
	
function applique_tva_avec_taux($nombre, $taux)
{
	return $nombre * $taux;
}	
echo applique_tva_avec_taux(1000, 1.2) . '<br />';
echo applique_tva_avec_taux(1000, 5.6) . '<br />';
	
// avec l'argument $taux initialisé par defaut:
function applique_tva_avec_taux2($nombre, $taux = 1.2)
{
	return $nombre * $taux;
}	
echo applique_tva_avec_taux2(1000) . '<br />'; // avec un argument initialisé par défaut, il devient facultatif. Si je ne fournis qu'un seul argument, alors $taux a par défaut la valeur 1.2
echo applique_tva_avec_taux2(1000, 5.6) . '<br />';	
	
	
// environnement global & local
// global => le script complet
// local  => à l'intérieur d'une fonction

function jour_semaine()
{
	$jour = 'lundi';
	return $jour;
}
// echo $jour; // $jour n'est pas défini dans l'espace global => erreur
echo jour_semaine() . '<br />';

$jour2 = jour_semaine();
echo $jour2 . '<br />';

// global vers local:
$pays = 'France';

affichage_pays(); // il est possible d'exécuter une fonction avant sa déclaration car l'interpréteur php charge toutes les fonctions du script avant d'exécuter le script.

function affichage_pays()
{
	global $pays; // grace au mot clé global, il est possible de récupérer une variable depuis l'espace global sinon ce n'est pas possible car nous sommes dans un espace local (dans une fonction)
	echo 'Le pays est: ' . $pays . '<br />';
}	

// affichage météo
function affichage_meteo($saison, $temperature)
{
	return "Nous sommes en " . $saison . ' et il fait ' . $temperature . ' degré(s)<br />';
	echo 'nous sommes mardi<br />'; // cette instruction ne sera jamais exécutée car après un return.
	// le return dans une fonction nous fait sortir de la fonction !
}

echo affichage_meteo('été', 27);
echo affichage_meteo('hiver', -1);
echo affichage_meteo('printemps', 18);
echo '<hr /><hr /><hr />';
// refaire la fonction affichage_meteo en gérant le "en" qui doit être "au" pour le printemps et également, il faut gérer le (s) de degré(s)
function meteo($saison, $temperature)
{
	$en = 'en';
	$s = 's';
	
	if($saison == 'printemps')
	{
		$en = 'au';
	}
	
	if($temperature > -2 && $temperature < 2)
	{
		$s = "";
	}

	return "Nous sommes " . $en . " " . $saison . ' et il fait ' . $temperature . ' degré' . $s . '<br />'; 
}
echo meteo('printemps', 18);
echo meteo('été', 18);
echo meteo('hiver', -3);
echo meteo('printemps', 0);
echo meteo('hiver', 1);
echo meteo('hiver', -1);








echo '<h1>Structure itérative: les boucles</h1>';

$i = 0; // valeur de depart
while($i < 10) // condition d'entrée
{
	echo $i . ' - ';
	$i++; // incrémentation ou décrementation // équivaut à écrire $i = $i+1
}
// EXERCICE refaire une boucle similaire en enlevant le dernier - affiché après la valeur 9:
// 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - (actuel)
// 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9   (voulu)
echo '<br />';
$y = 0;
while($y < 10)
{
	if($y == 9)
	{
		echo $y;		
	}
	else {
		echo $y . ' - ';		
	}	
	$y++;
}
echo '<br />';
// boucle for
// for( valeur_de_depart; condition_dentree; incrementation)	
	
for($i = 0; $i < 10; $i++)	
{
	echo $i;
}

// afficher en utilisant while ou for un tableau html contenant 10 cellules
// exemple
?>
<table style="border-collapse: collapse; width: 100%;" border="1">
	<tr>
		<td>0</td>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>
		<td>7</td>
		<td>8</td>
		<td>9</td>
	</tr>
</table>
<hr />
<?php		
echo '<table style="border-collapse: collapse; width: 100%; text-align: center;" border="1"><tr>';

for($i = 0; $i < 10; $i++)
{
	echo '<td>' . $i . '</td>'; 
}

echo '</tr></table>';

echo '<hr /><hr />';
// pour aller plus loin faire un tableau allant de 0 à 99 avec 10 cellules x 10 lignes	
echo '<table style="border-collapse: collapse; width: 100%; text-align: center;" border="1">';
for($y = 0; $y < 10; $y++)
{
	echo '<tr>';
	for($i = 0; $i < 10; $i++)
	{
		echo '<td>' . (($y*10)+$i) . '</td>'; 
	}
	echo '</tr>';
}
echo '</table>';

echo '<hr /><hr />';
// pour aller plus loin faire un tableau allant de 0 à 99 avec 10 cellules x 10 lignes	
echo '<table style="border-collapse: collapse; width: 100%; text-align: center; color: red;" border="1">';
$xx = 0;
for($y = 0; $y < 10; $y++)
{
	echo '<tr>';
	for($i = 0; $i < 10; $i++)
	{
		echo '<td>' . $xx . '</td>';
		$xx++;
	}
	echo '</tr>';
}
echo '</table>';
	
echo '<hr /><hr />';
// pour aller plus loin faire un tableau allant de 0 à 99 avec 10 cellules x 10 lignes	
echo '<table style="border-collapse: collapse; width: 100%; text-align: center; color: green;" border="1">';
for($y = 0; $y < 10; $y++)
{
	echo '<tr>';
	for($i = 0; $i < 10; $i++)
	{
		echo '<td>' . $y . $i . '</td>';
	}
	echo '</tr>';
}
echo '</table>';




echo '<h1>Inclusion de fichier</h1>';	
// créez un fichier dans le même dossier que celui-ci: exemple.inc.php
// dans ce fichier mettez du texte. (lorem ipsum, html, ...)
	
echo '<b>Première fois avec include:</b><br />';
include("exemple.inc.php");

echo '<hr /><b>deuxième fois avec include_once:</b><br />';
include_once("exemple.inc.php");
	
echo '<hr /><b>Première fois avec require:</b><br />';
require("exemple.inc.php");	
	
echo '<hr /><b>deuxième fois avec require_once:</b><br />';
require_once("exemple.inc.php");	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	







echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
