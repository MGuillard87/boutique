<?php
// fonction qui permet de se connecter à MySQL

function connectionBdd()
{
    try {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=datashop;charset=utf8', 'root', '@lex1987');
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
    return $bdd;
}

// Fonction qui permet d'afficher une table
function afficheTable($table, $bdd)
{
// On récupère tout le contenu de la table datashop
    $reponse = $bdd->query('SELECT * FROM $table');
    return $reponse;
}



