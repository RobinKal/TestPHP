<?php
session_start();
include_once __DIR__. '/header.php';
//require __DIR__. '/my-functions.php';
include_once __DIR__. '/catalog.php';
//include __DIR__. ('/sql-queries.php');
include_once __DIR__. '/connect.php';
include_once __DIR__ . '/Classes/Item.php';
include_once __DIR__ . '/Classes/Catalogue.php';

global $mysqlConnection;

# ****** initialisation de l'array catalog *******

$catalog = getAllProducts($mysqlConnection);
$Catalogue1 = new Catalogue($catalog);


# ***** DISPLAY ******

echo '<div class="container-full row ptblr-5 d-flex justify-content-around">';
displayCatalogue($Catalogue1);

echo '</div>';
include 'footer.php';