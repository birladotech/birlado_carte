<?php

/**
 * connection database
 *
 * @return PDO
 */
function loadDB(): PDO
{

    $dbName = "rithler_news";
    $password = "root";
    $username = "root";

    try {
        //code...
        $bdd = new PDO("mysql:host=localhost;dbname=$dbName", $username, $password, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        return $bdd;
    } catch (PDOException $e) {
        echo "erreur de connexion a la base de donnee " . $e->getMessage();
    }
}
