<style>
	* 	{	font-family: calibri;}
	h1 	{ 	padding: 10px; 
			color: white; 
			background-color: darkslategray;
		}
</style>
<h1>Ecriture et affichage</h1>
<!--tout d'abord, il est possible d'écrire du HTML dans un fichier .php, en revanche l'inverse n'est pas possible-->

<?php //balise php ouverture et fermeture ?>

<?php

//instruction d'affichage
//variable: type / déclaration/affectation
//concatenation
//guillemets et quotes (guillemets simples et doubles)
// constante
// condition et opérateurs de comparaison
// fonction prédéfinie
// fonction utilisateur
// boucle
// inclusion
// array
// classes et objet

echo 'Bonjour';
echo '<br>';
echo 'Bienvenue<br>';
print 'Print est une autre instruction d\'affichage similaire à echo<br />';

//les commentaires en PHP:
//ceci est un commentaire sur une ligne
# ceci est un commentaire sur une seule ligne
/*
ceci est un commentaire sur plusieurs lignes
 */

//autres instructions d'affichage mais spécifiques aux phase de développement: print_r() & var_dump()

echo '<h1>Variables: types / déclaration / affectation</h1>';
// définition: une variable est un espace nommé permettant de conserver une valeur
// déclaration d'une variable avec le signe $
// une variable est sensible à la casse
// caractères autorisés: de a à z, 0 à 9 et le _ // /!\ 
// une variable ne peut pas commencer par un chiffre

//  affectation d'une valeur avec le signe =
$a = 127;
echo gettype($a); // int
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

$a = true; // ou false
echo gettype($a); // boolean
echo '<br />';

echo '<h1>Concaténation</h1>';
// en php nous utiliserons le '.' pour la concaténation que l'on peut traduire par "suivi de"
$x = "Bonjour ";
$y = "tout le monde";
echo $x . ' ' . $y . '<br />';

echo "<br />", 'Coucou', '<br />'; // il est possible de faire la concaténation avec une ',' en revanche uniquement avec echo. (erreur avec print)

echo '<h1>Concaténation lors de l\'affectation</h1>';
$prenom1 = "Bruno";
$prenom1 = "Claire";

echo $prenom1 . '<br />'; // affiche Claire

$prenom2 = "Bruno ";
$prenom2 .= "Claire"; // équivalent à écrire $prenom2 = $prenom2 . 'Claire';
// le .= permet de rajouter à l'existant sans l'écraser
echo $prenom2 . '<br />';

echo '<h1>Guillemets & Quotes</h1>';

$message = "Aujourd'hui";
// ou
$message = 'Aujourd\'hui';

// concaténation
echo $message . ' il fait chaud<br />';
echo "$message il fait chaud <br />"; // dans des guillemets, les variables sont reconnues et donc interprétées
echo '$message il fait chaud <br />'; // dans des quotes, les variables ne sont pas reconnues et interprétées comme du texte

echo '<h1>Les constantes & constantes magiques</h1>';
// une constante est un peu comme une variable, un espace nommé nous permettant de conserver une valeur sauf que comme son nom l'indique, cette valeur ne pourra pas changer durant l'exécution du script
define("CAPITALE", "Paris"); 
// 1er argument: le nom de la constante / 2eme argument: sa valeur
// par convention, une constante s'écrit toujours en majuscule
echo CAPITALE . '<br />';

// constante magique
echo __FILE__ . '<br />'; // affiche le chemin complet jusqu'à ce fichier
echo __LINE__ . '<br />'; // affiche le numéro de la ligne

echo '<h1>Exercice sur les variables</h1>';
// mettre les valeurs "lundi" "mardi" "mercredi" dans 3 variables
// afficher "lundi - mardi - mercredi" en appelant les variables

$j1 = "lundi";
$j2 = "mardi";
$j3 = "mercredi";
$sep = " - ";

echo $j1 . ' - ' . $j2 . ' - ' . $j3 . '<br />';
echo "$j1 - $j2 - $j3";
echo $j1 . $sep . $j2 . $sep . $j3 . '<br />';

echo '<h1>Opérateurs arithmétiques</h1>';
$a = 10; $b = 2;
echo $a + $b .'<br />';
echo $a - $b .'<br />';
echo $a * $b .'<br />';
echo $a / $b .'<br />';
echo $a % $b .'<br />';

// facilité d'écriture:
echo $a += $b . '<br />'; // équivaut à $a = $a + $b
echo $a -= $b . '<br />';
echo $a *= $b . '<br />';
echo $a /= $b . '<br />';

echo '<h1>Structure conditionnelle (if/else if/else) et opérateurs de comparaison</h1>';
// isset - empty
// isset test si l'élément existe (s'il a été déclaré au préalable dans notre script par exemple)
// empty test si l'élément est vide (à savoir, empty vérifie au préalable si l'élément est défini avant de tester s'il est vide)

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
$a = 10;
$b = 5;
$c = 2;

if($a > $b)
{
	print "'a' est bien supérieur à 'b'<br />";
}
else
{
	print "'a' n'est pas supérieur à 'b'<br />";
}

// ET (&& - AND)
if($a > $b && $b > $c)
{
	echo 'OK pour les deux conditions<br />';
}

// OU (|| - OR)
if($a == 9 || $b > $c)
{
	echo 'OK pour l\'une des deux conditions<br/>';
}

// XOR - on ne rentre dans la condition que si l'une des deux conditions est vrai. si les deux conditions sont vrais, on ne rentre pas
if($a == 10 XOR $b < $c)
{
	echo 'OK pour une des deux conditions<br />';
}
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
	echo "C'est la même chose<br />";
}
if($a1 === $a2)
{
	echo "C'est la même chose<br />";
}
/*
	=		Affectation
	==		Comparaison des valeurs
	===		Comparaison des valeurs & de types
	!= 		Différent de (en terme de valeur)
	!==		Différent de (en terme de valeur ou de type)
	>		Strictement supérieur
	<		Strictement inférieur
	>=		Supérieur ou égal
	<=		inférieur ou égal
 */

// forme contractée des if/else: autre écriture
echo ($a == 10) ? 'if en forme contractée<br />' : 'else en forme contractée<br />';
// '?' = if
// ':' = else

echo '<h1>Condition switch</h1>';
// les cases représentent des cas différents dans lesquels nous pouvons potentiellement rentrer
$couleur = 'jaune';
switch($couleur)
{
	case 'bleu':
		echo 'Vous aimez le bleu<br />';
	break;
	case 'rouge':
		echo 'Vous kiffez le rouge<br/>';
	break;
	case 'vert':
		echo 'Vous kiffez le vert<br/>';
	break;
	default: // toutes les autres possibilités
		echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br />";
	break;
}

// Exo: refaire la condition précédente avec if / elseif / else

if($couleur == 'bleu')
{
	echo "bleu";
}
elseif($couleur == 'rouge')
{
	echo "rouge";
}
elseif($couleur == 'vert')
{
	echo "vert";
}
else{
	echo "t'aimes rien";
}

echo '<h1>Fonction prédéfinie</h1>';
// une fonction prédéfinie est déjà inscrite dans le langage, le développeur ne fait que l'exécuter
echo 'Date du jour:<br />';
echo date("d-M-Y h:i A");
// date est une fonction prédéfinie permettant d'afficher la date
// en argument cette fonction accepte une chaine de caractère
// selon les caractères fournis, cette fonction nous renvoie différent format de date
// voir la doc pour les formats disponibles: http://php.net/manual/fr/function.date.php
echo '<hr />' . time() . '<hr />';
// time() nous affiche le timestamp (nb de seconde écoulée depuis le 1er janvier 1970)

// traitement des chaines (iconv_strlen() / strpos() / substr())
$email = 'mathieuquittard@evogue.fr';
echo strpos($email, '@') . '<br />';
// strpos permet de chercher dans une chaine (fournie en 1er argument) une autre chaine (fournie en 2eme argument)
// /!\ dans une chaine le premier caractère à la position 0

// valeur de retour
	// Succes => on obtient un int (la position)

$email2 = "azergarf";
echo strpos($email2, '@') . '<br />';
var_dump(strpos($email2, '@'));
// var_dump() est une instruction d'affichage ameliorée nous affichant la valeur de ce que l'on test + son type et si le type est string on obtient également sa longueur
// ici var_dump() nous permet de voir le false obtenu via la fonction strpos()

// iconv_strlen
$phrase = 'Lorem ipsum dolor sit amet';

echo iconv_strlen($phrase) . '<br />';
// iconv_strlen permet de compter le nombre de caractère
// valeur de retour en cas de succès => int (la longueur de la chaine)

//substr
$texte = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mauris augue, feugiat non orci et, ullamcorper faucibus augue. Maecenas viverra dolor ex, suscipit ultricies massa porta quis. Pellentesque tincidunt fringilla turpis, et volutpat leo facilisis nec. In hendrerit scelerisque pharetra. Integer venenatis, turpis eget rutrum pretium, sapien odio faucibus odio, id malesuada lorem massa vel sem.";

echo substr($texte, 0, 35) . " ...<a href='#''>Lire la suite</a>";
// substr permet de découper une chaine
	// 1er argument => la chaine à découper
	// 2eme argument => la position de départ
	// 3eme argument => le nombre de caractères à renvoyer. (cet argument est facultatif, s'il n'est pas présent on récupère tout depuis la position de départ)

echo '<h1>Fonction utilisateur</h1>';
// non inscrite au langage, c'est le développeur qui les déclare puis les exécute

// déclaration d'une fonction
function separation()
{
	echo '<hr /><hr /><hr />';
}

// execution
separation();

// fonction avec 1 argument
function bonjour($qui)
{
	return "Bonjour " . $qui . '<br />';
}
// une return nous renvoie le résultat de cette fonction en revanche si l'on veut faire un affichage il faudra passer par un echo
echo bonjour('Mathieu');
$prenom = "Luneth";
echo bonjour($prenom);

// fonction pour appliquer la TVA
function applique_tva($nombre)
{
	return $nombre * 1.2;
}
echo applique_tva(1000) . '<br />';

// Exo: refaire la fonction précédente en donnant la possibilité à l'utilisateur de choisir le taux (que ce ne soit pas figé sur le taux 1.2)

function applique_tva2($nombre, $taux)
{
	return $nombre * $taux;
}
echo applique_tva2(1000, 5.5) . '<br />';

// avec l'argument $taux initialisé par défaut:
function applique_tva3($nombre, $taux = 1.2)
{
	return $nombre * $taux;
}
echo applique_tva3(1000, 5.5) . '<br />';
echo applique_tva3(1000) . '<br />';
// avec un argument initialisé par défaut, il devient facultatif. si je ne fournis qu'un seul argument, alors $taux prend la valeur par défaut 1.2

// environnement global et local
// global => le script complet
// local => à l'intérieur d'une fonction

function jour_semaine()
{
	$jour = 'lundi';
	return $jour;
} 
// echo $jour; // $jour n'est pas défini dans l'espace global => erreur
echo jour_semaine() . '<br />';

$jour2 = jour_semaine();
echo $jour2 . '<br />';

// global vers local
$pays = 'France';
affichage_pays(); // il est possible d'exécuter une fonction avant sa déclaration car l'interpreteur php charge toutes les fonctions du script avant d'exécuter le script

function affichage_pays()
{
	global $pays; // grace au mot clef global, il est possible de récupérer une variable depuis l'espace global sinon ce n'est pas possible car nous sommes dans un espace local
	echo 'Le pays est: ' . $pays . '<br />';
}

echo '<h1>Structure itérative: les boucles</h1>';

$i = 0; // valeur de départ

while($i < 10) // condition d'entrée
{
	echo $i . ' - ';
	$i ++; // incrémentation ou décrémentation // équivaut à écrire $i = $i+1
}

echo '<br />';

$j = 0;

while($j < 9)
{	
	echo $j . ' - ';
	if($j == 8){
		echo '9';
	}
	$j ++;
}

echo '<br />';

$y = 0;
while($y < 10)
{
	if($y == 9)
	{
		echo $y;
	}
	else{
		echo $y . ' - ';
	}

	$y ++;
}

echo '<br />';

// boucle for
// for(valeur_de_depart; condition_dentree; incrementation)

// EXO: afficher en utilisant while ou for un tableau HTML contenant 10 cellules

echo '<table style="border-collapse: collapse; width: 100%; text-align: center;" border="1";><tr>';

for($r = 0; $r < 10; $r++)
{
	echo '<td>' . $r . '</td>';
}
echo '</tr></table>';

echo '<hr />';

// Pour aller plus loin, faire un tableau allant de 0 à 99 avec 10 cellules x 10 lignes

echo '<table style="border-collapse: collapse; width: 100%; text-align: center;" border="1";>';
// $u
for($s = 0; $s < 10; $s++)
{
	echo '<tr>';
	for($t = 0; $t < 10; $t++)
	{
	echo '<td>' . ($t + ($s * 10)) . '</td>';
	// echo '<td>' . $u . '</td>';
	// $u++;
	}
	echo '</tr>';
}
echo '</table>';

echo '<hr />';

// affichage meteo

function affichage_meteo($saison, $temperature)
{
	return "Nous sommes en " . $saison . ' et il fait ' . $temperature . ' degré(s)<br />';
	echo 'nous sommes mardi<br />'; 
	// cette instruction ne sera jamais executée car après un return.
	// le return dans une fonction nous fait sortir de la fonction
}
echo affichage_meteo('été', 27);
echo affichage_meteo('hiver', -1);
echo affichage_meteo('printemps', 18);

echo '<hr />';
// refaire la fonction affichage_meteo en gérant le "en" qui doit être "au" pour le printemps et également, il faut gérer le (s) de degré(s)

function meteo($saiz, $temp)
{
	$en = 'en';
	$ss = 's';

	if($saiz == 'printemps')
	{
		$en = 'au';
	}
	if($temp < 2 && $temp > -2)
	{
		$ss = "";
	}
	return "Nous sommes " . $en . " " . $saiz . ' et il fait ' . $temp . ' degré' . $ss .'<br />';
	echo 'nous sommes mardi<br />';
}
echo meteo('été', 27);
echo meteo('hiver', -1);
echo meteo('printemps', 18);

echo '<h1>Inclusion de fichier</h1>';

// créez un fichier dans le même dossier que celui-ci: exemple.inc.php
// dans ce fichier mettez du texte

echo '<hr /><b>Première fois avec include:</b><br />';
include("exemple.inc.php");

echo '<hr /><b>Deuxième fois avec include_once:</b><br />';
include_once("exemple.inc.php");

echo '<hr /><b>Première fois avec require:</b><br />';
require("exemple.inc.php");

echo '<hr /><b>Deuxième fois avec require_once:</b><br />';
require_once("exemple.inc.php");

/*
Différence entre include et require:
En cas d'erreur, par exemple, une faut de frappe sur le nom du fichier ou le fichier a été déplacé, etc...
- Include provoque une erreur MAIS continu l'exécution du script
- Require provoque une erreur ET bloque l'exécution la suite du script
 */

echo '<h1>Les tableaux ARRAY</h1>';

// un tableau array est déclaré un peu comme une variable sauf qu'au lieu de ne conserver qu'une seule et unique valeur, dans un tableau nous allons avoir un ensemble de valeur.

// déclaration d'un tableau
$tableau = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");

// outil pour pouvoir voir le contenu du tableau:
echo '<b>Affichage du tableau avec print_r:</b>';
echo'<pre>'; print_r($tableau); echo '</pre>';

echo '<b>Affichage du tableau avec var_dump:</b>';
echo'<pre>'; var_dump($tableau); echo '</pre>';

// autre façon de déclarer un tableau array

$tab[] = "France";
$tab[] = "Italie";
$tab[] = "Allemagne";
$tab[] = "Angleterre";
$tab[] = "Portugal";
$tab[] = "Belgique";
$tab[] = "Hollande";

echo'<pre>'; var_dump($tab); echo '</pre>';
echo $tab[2] . '<br />'; // pour extraire un élément du tableau array, on appelle l'indice correspondant
// dans le doute, faire un var_dump ou print_r pour vérification
echo '<hr />';
// Boucle foreach pour les tableaux de données ARRAY ou Object
foreach($tab AS $valeur)
{
	// foreach est un outil pour faire une boucle spécifique aux tableaux array & object
	// cette boucle est dynamique et tournera autant de fois qu'il y a d'éléments dans notre tableau ou objet
	// le mot clé AS est obligatoire et permet de donner un alias via une variable qui représentera à chaque tour de boucle la valeur en cours
	echo $valeur . '<br />';
}

echo '<hr />';
// pour récupérer également l'indice en cours, il nous suffit de rajouter une variable de réception après le mot clé AS:
foreach($tab AS $ind => $val)
{
	echo $ind . ' - ' . $val . '<br />';
}

// il est possible de choisir nous même les indices
$plats = array( 'un' => 'Pâtes', 'deux' => 'Crêpes', 'trois' => 'Salade de fruits', 77 => 'Eau');
echo '<pre>'; var_dump($plats); echo '</pre>';
$color = array();

$color['j'] = 'jaune';
$color['b'] = 'bleu';
$color['w'] = 'white';
$color['r'] = 'rouge';
$color['v'] = 'vert';
$color['p'] = 'pourpre';
echo '<pre>'; var_dump($color); echo '</pre>';
echo $color['b'] . '<br />';

// Pour connaître la taille d'un tableau (combien d'éléments dans le tableau array)
echo 'Taille du tableau couleur: ' . count($couleur) . '<br />';
echo 'Taille du tableau couleur: ' . sizeof($couleur) . '<br />';

echo '<h1>Tableau array multidimensionnel</h1>';
// nous parlons de tableaux array multidimensionnel lorsqu'un tableau est lui même contenu dans un autre tableau

$tableau_etudiants = array( 
	0 => array('pseudo' => 'Marie', 'Nom' => 'Durand', 'email' => 'marie@email.fr'), 
	1 => array('pseudo' => 'Luc', 'Nom' => 'Dupond', 'email' => 'luc@email.fr'), 
	2 => array('pseudo' => 'Jean', 'Nom' => 'Jean', 'email' => 'jean@email.fr')
	);
echo '<pre>'; print_r($tableau_etudiants); echo '</pre>';

echo $tableau_etudiants[1]['email'] . '<hr />; // nous rentrons d'abords à l'indice 1 du premier niveau puis à l'indice 'email' du deuxième niveau

$taille_tableau = count($tableau_etudiants);
for($i = 0; $i < $taille_tableau; $i++)
{
	// afficher les emails du deuxieme niveau de ce tableau
	echo $tableau_etudiants[$i]['email'] . '<br />';
}
echo '<hr>';
// avec un foreach
foreach ($tableau_etudiants AS $valeur) 
{
	echo $valeur['email'] . '<br>';
}
echo '<hr>';
// avec double foreach
foreach ($tableau_etudiants AS $valeur)
{
	foreach($valeur AS $val)
	{
		echo $val . '<br>';
	}
	echo '<hr>';
}

echo '<h1>Les Objets</h1>';
// un objet est un autre type de données. Un peu à la manière d'un array, il permet de conserver des valeurs mais cela va plus loin puisqu'on peut également avoir des fonctions dans un objet
// une information dans un objet s'appelle une propriété ou attribut
// une fonction dans un objet s'appelle une méthode

// un objet est toujours issu d'une classe (son modèle de construction)

// pour déclarer une classe
class Etudiant
{
	public $prenom = 'Marie';
	// public est un mot clé permettant de préciser que l'élément sera accessible directement sur l'objet. Sinon il faudrait passer par des méthodes permettant de récupérer cette propriété ou de la modifier. (il existe aussi protected/private/static)
	public $age = 25;
	public function pays()
	{
		return 'France';
	}
}
// un objet est un conteneur symbolique, qui possède sa propre existence et incorpore des informations (propriétés) et des fonctions (methodes)

// pour instancier un objet:
$mon_objet_1 = new Etudiant(); // new est un mot clé obligatoire permettant d'instancier un objet depuis une classe
$mon_objet_2 = new Etudiant();

echo '<pre>'; var_dump($mon_objet_1); echo '</pre>';
echo '<pre>'; var_dump($mon_objet_2); echo '</pre>';

// pour voir les méthodes de l'objet
echo '<pre>'; var_dump(get_class_methods($mon_objet_1)); echo '</pre>';

// pour récupérer une propriété de l'objet
echo $mon_objet_1->prenom . '<br>';
// pour récupérer une propriété de l'objet
echo $mon_objet_1->pays() . '<br>';

// pour récupérer une propriété de l'objet
$mon_objet_1->prenom = "Pierre";
echo $mon_objet_1->prenom . '<br>';