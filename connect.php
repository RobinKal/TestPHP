<?php

try {
// On se connecte à MySQL
    $mysqlConnection = new PDO(
        'mysql:host=localhost;dbname=amazen;charset=utf8',
        'robin_kalck',
        'test321'
    );
}
// En cas d'erreur, on affiche un message et on arrête tout, autrement on continue
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}