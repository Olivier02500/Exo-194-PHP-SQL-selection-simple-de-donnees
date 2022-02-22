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
$password = '';
$db = 'sql-test';

try {
    $pdo = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM user");
    $state = $stmt->execute();

    if($state){
        foreach ($stmt->fetchAll() as $user){
            echo "<span class='title'>Utilisateur: </span>" . $user['id']
                . "<div class='user'>"
                . $user['nom'] . " "
                . $user['prenom'] . " "
                . $user['numero'] . " "
                . $user['rue'] . " "
                . $user['code_postal'] . " "
                . $user['ville'] . " "
                . $user['pays'] . " "
                . $user['mail'] . " "
                . "</div>"
                . "<br><hr>";
        }
    }
    $stmt = $pdo->prepare("SELECT * FROM user ORDER BY id DESC ");
    $state = $stmt->execute();
    if($state){
        foreach ($stmt->fetchAll() as $user){
            echo "<span class='title'>Utilisateur: </span>" . $user['id']
                . "<div class='user'>"
                . $user['nom'] . " "
                . $user['prenom'] . " "
                . $user['numero'] . " "
                . $user['rue'] . " "
                . $user['code_postal'] . " "
                . $user['ville'] . " "
                . $user['pays'] . " "
                . $user['mail'] . " "
                . "</div>"
                . "<br><hr>";
        }
    }
    $stmt = $pdo->prepare("SELECT nom, prenom FROM user");
    $state = $stmt->execute();
    if($state){
        foreach ($stmt->fetchAll() as $user){
            echo "<span class='title'>Utilisateur: </span>"
                . "<div class='user'>"
                . $user['nom']  . " "
                . $user['prenom']  . " "
                . "</div>"
                ."<br><hr>";
        }
    }

}
catch (PDOException $e){
    echo $e->getMessage();
}