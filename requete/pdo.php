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