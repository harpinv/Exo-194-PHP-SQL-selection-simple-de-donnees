<?php

/**
 * 1. Importez le fichier SQL se trouvant dans le dossier SQL.
 * 2. Connectez vous à votre base de données avec PHP
 * 3. Sélectionnez tous les utilisateurs et affichez toutes les infos proprement dans un div avec du css
 *    ex:  <div class="classe-css-utilisateur">
 *              utilisateur 1, données ( nom, prenom, etc ... )
 *         </div>
 *         <div class="classe-css-utilisateur">
 *              utilisateur 2, données ( nom, prenom, etc ... )
 *         </div>
 * 4. Faites la même chose, mais cette fois ci, triez le résultat selon la colonne ID, du plus grand au plus petit.
 * 5. Faites la même chose, mais cette fois ci en ne sélectionnant que les noms et les prénoms.
 */

$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'bdd_cours';

try {

    $maConnexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);
    $maConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $maConnexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pom = $maConnexion->prepare("SELECT id, nom, prenom, rue, numero, code postal, ville, pays, mail FROM user");

    $state = $pom->execute();

    if($state) {
        foreach($pom->fetchAll() as $user) {
            echo "<div>Personne " . $user['id'] . ":" . $user['nom'] . " " . $user['prenom'] . " " . $user['rue'] . " " . $user['numero'] . " " . $user['code postal'] . " " . $user['ville'] . " " . $user['pays'] . " " . $user['mail'] . "</div>";
        }
    }
    else {
        echo "Une erreur est survenue en récupérant les données de la table.";
    }

    $pom = $maConnexion->prepare("SELECT * from user ORDER BY id DESC");

    $state = $pom->execute();

    if($state) {
        foreach($pom->fetchAll() as $user) {
            echo "<div>Personne " . $user['id'] . ":" . $user['nom'] . " " . $user['prenom'] . " " . $user['rue'] . " " . $user['numero'] . " " . $user['code postal'] . " " . $user['ville'] . " " . $user['pays'] . " " . $user['mail'] . "</div>";
        }
    }
    else {
        echo "Une erreur est survenue en récupérant les données de la table.";
    }

    $pom = $maConnexion->prepare("SELECT nom, prenom FROM user");

    $state = $pom->execute();

    if($state) {
        foreach($pom->fetchAll() as $user) {
            echo "<div>Personne :" . $user['nom'] . " " . $user['prenom'] . "</div>";
        }
    }
    else {
        echo "Une erreur est survenue en récupérant les données de la table.";
    }
}
catch (PDOException $exception) {
    echo "Erreur de connexion: " . $exception->getMessage();
}

