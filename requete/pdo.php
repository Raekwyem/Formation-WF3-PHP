<?php
/*
// PDO => Php Data Object

// EXEC()
	INSERT, UPDATE, DELETE: Exec() est une methode de l'objet pdo qui est utilisée pour la formulation de requete ne retournant pas de résultat
	Valeur de retour:
	----------------
	succes => on obtient un entier (int) correspondant au nombre de lignes affectées.
	echec => on obtient le boolean false

// QUERY()
	INSERT, UPDATE, DELETE, SELECT, SHOW, ...: Query() est utilisé pour tout type de requête
	valeur de retour:
	-----------------
	succes => on obtient un nouvel objet issue de la class PDOStatement
	echec => on obtient le booleen false

// PREPARE() + EXECUTE()
	INSERT, UPDATE, DELETE, SELECT, SHOW, ...: prepare() permet de préparer la requête mais ne l'execute pas; execute() execute la requete
	valeur de retour:
	-----------------
	prepare() => on obtient un nouvel objet issue de la classe PDOStatement
	execute() =>
		succes => PDOStatement
		echec => false
	
	// les requetes préparées sont à préconiser pour sécuriser les données.
	// cela permet également d'éviter le cycle complet d'une requete:
	analyse / interprétation / exécution

*/

// connexion à une BDD
$pdo = new PDO('mysql:host=localhost;dbname=wf3_entreprise', 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// arguments: 1 - (serveur+nom_bdd) 2 - identifiant 3 - mot de passe 4 - options
// echo '<pre>'; var_dump($pdo); echo '</pre>';
// echo '<pre>'; var_dump(get_class_methods($pdo)); echo '</pre>';

// 2 - PDO: exec()
// insert
// $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES ('prenomtest', 'nomtest', 'm', 'informatique', 2000, '2017-06-22')");
// echo "nombre de lignes insérées par la dernière requête: " . $resultat . '<br>';
// echo '<pre>'; var_dump($resultat); echo '</pre>';

// 3 - PDO: QUERY => SELECT + FETCH (pour un seul resultat)
$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes=350");
echo '<pre>'; var_dump($resultat); echo '</pre>';
// echo '<pre>'; var_dump(get_class_methods($resultat)); echo '</pre>';

// en l'etat, $resultat est inexploitable. Nous devons le traiter avec la methode fetch afin de rendre les informations exploitables.

$info_employe = $resultat->fetch(PDO::FETCH_ASSOC);
// FETCH_ASSOC pour un tableau array associatif (le nom des colonnes comme indices du tableau)

//$info_employe = $resultat->fetch(PDO::FETCH_NUM) // FETCH_NUM pour un tableau indexé numériquement

//$info_employe = $resultat->fetch(); // ou $info_employe = $resultat->fetch(PDO::FETCH_BOTH); // c'est le mode par défaut // FETCH_BOTH est un mélange de FETCH_ASSOC + FETCH_NUM

//$info_employe = $resultat->fetch(PDO::FETCH_OBJ); // FETCH_OBJ pour obtenir un objet avec les éléments disponibles en propriétés publiques

echo '<pre>'; print_r($info_employe); echo '</pre>';

echo $info_employe['prenom'] . '<hr>'; // avec FETCH_ASSOC
//echo $info_employe[1] . '<hr>'; // avec FETCH_NUM
//echo $info_employe->prenom . '<hr>'; // avec FETCH_OBJ

/*
$pdo représente un objet[1] issue de la classe prédéfinie PDO
Quand on execute une requete de selection avec la methode query sur notre objet $pdo:
On obtient un nouvel objet[2] issue de la classe PDOStatement. Cet objet a donc des propriétés et méthodes différentes.

$resultat représente la réponse de la BDD et c'est un résultat inexploitable en l'état
$info_employe est la réponse exploitable (grace au fetch())
/!\ attention, il faut choisir l'un des traitements fetch(PDO::...)
Il n'est pas possible d'appliquer plusieurs traiment fetch sur un même résultat

Le résultat est la réponse de la BDD et est inexploitable car Mysql nous renvoir beaucoup d'informations. Le fetch permet de les organiser.
 */

// 4- PDO: QUERY + WHILE + FETCH (plusieurs résultats)
$resultat = $pdo->query("SELECT * FROM employes");

echo "Le nombre d'employes: " . $resultat->rowCount() . '<br>'; // la methode rowCount() de l'objet PDOStatement retourne le nombre de ligne dans notre résultat

while($info_employe = $resultat->fetch(PDO::FETCH_ASSOC))
{
	// à chaque tour de la boucle while, on traite avec un fetch la ligne en cours et on passe à la suivante
	//echo '<pre>'; print_r($info_employe); echo '</pre>'; echo '<hr>';
	echo '<div style="box-sizing: border-box; padding: 10px; background-color: darkred; color: white; display: inline-block; width: 23%; margin: 1%;">';

	echo 'ID: ' . $info_employe['id_employes'] . '<br>';
	echo 'Nom: ' . $info_employe['nom'] . '<br>';
	echo 'Prénom: ' . $info_employe['prenom'] . '<br>';
	echo 'Salaire: ' . $info_employe['salaire'] . '<br>';
	echo 'Sexe: ' . $info_employe['sexe'] . '<br>';
	echo 'Service: ' . $info_employe['service'] . '<br>';
	echo 'Date d\'embauche: ' . $info_employe['date_embauche'] . '<br>';

	echo '</div>';
}

// 5 - Exo
// récupérer la liste des BDD présentent sur le serveur
// les traiter puis les afficher dans une liste ul li
// Attention à l'indice si vous utilisez FETCH_ASSOC (les indices sont sensibles à la casse) Sur cette requete il y a une majuscule dans l'indice récupéré.

$resultat = $pdo->query("SHOW DATABASES");
// echo '<pre>'; print_r($resultat); echo '</pre>'; echo '<hr>';
// echo $resultat->rowCount();

echo '<ul>';
while($bdd = $resultat->fetch(PDO::FETCH_ASSOC))
{
	//echo '<pre>'; print_r($bdd); echo '</pre>'; echo '<hr>';
	echo '<li>' . $bdd['Database'] . '</li>';
}
echo '</ul>';

// 6 - PDO: QUERY + FETCHALL + FETCH_ASSOC (plusieurs résultats)

$resultat = $pdo->query("SELECT * FROM employes");
//fetchAll
$liste_employes = $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($liste_employes); echo '</pre>'; echo '<hr>';
// fetchAll() traite toutes les lignes dans notre résultat et on obtient un tableau array multidimensionnel
// 1er niveau la ligne en cours, 2eme niveau les informations de la ligne

foreach($liste_employes AS $valeur)
{
	echo $valeur['prenom'] . '<br />';
}

// 7 - PDO: QUERY + AFFICHAGE EN TABLEAU

//$pdo = new PDO('mysql:host=localhost; dbname=wf3_bibliotheque', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES'))
$resultat = $pdo->query("SELECT * FROM employes");

//balise ouverture du tableau
echo '<table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">';
//première ligne du tableau pour le nom des colonnes
echo '<tr>';
// récupération du nombre de colonnes dans la requête
$nb_col = $resultat->columnCount();

for($i = 0; $i < $nb_col; $i++)
{
	// echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr>';
	$colonne = $resultat->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
	echo '<th style="padding: 10px;">' . $colonne['name'] . '</th>';
}

echo '</tr>';

while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
{
	echo '<tr>';

	foreach($ligne AS $info)
	{
		echo '<td style="padding: 10px;">' . $info . '</td>';
	}

	echo '</tr>';
}

echo '</table>';

/*---------------------*\
SECURISATION DES DONNEES
\*---------------------*/

// 8 - PDO: PREPARE + BINDPARAM + EXECUTE

$nom = "Laborde";

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // :nom est un marqueur nominatif

// nous pouvons maintenant fournir la valeur du marqueur :nom
$resultat->bindParam(":nom", $nom, PDO::PARAM_STR); 
// bindParam(nom_du_marqueur, valeur_du_marqueur, type_attendu)

$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>'; echo '<hr>';

// BINDPARAM n'accepte que des valeurs sous forme de variable

// implode() & explode() (fonctions prédéfinies)
// implode() permet d'afficher tous les éléments d'un tableau array séparées par un séparateur fourni en 2eme argument
// explode() découpe une chaine de caractères selon un séparateur fourni en deuxième argument et place chaque segment de cette chaine dans un tableau array à des indices différents
// exemple:
implode('<br />', $donnees);

// 8 - PDO: PREPARE + BINDVALUE + EXECUTE

echo '<hr><hr><hr>';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE id_employes = :id");
// :nom est un marqueur nominatif
$resultat->bindValue(":id", 350, PDO::PARAM_INT);
// bindValue(nom_du_marqueur, valeur_du_marqueur, type_attendu)
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>'; echo '<hr>';

// BINDVALUE accepte une variable ou la valeur directement pour le marqueur (ce n'est pas le cas de bindParam qui n'accepte qu'une variable)