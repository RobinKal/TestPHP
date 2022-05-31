<?php
session_start();
include __DIR__. '/header.php';
//require __DIR__. '/my-functions.php';
include __DIR__. ('/catalog.php');
//include __DIR__. ('/sql-queries.php');
include __DIR__. ('/connect.php');
include __DIR__. ('/public/lib/Item.php');
include __DIR__. ('/public/lib/Catalogue.php');

global $mysqlConnection;

# ****** initialisation de l'array catalog

$catalog = getAllProducts($mysqlConnection);
$Catalogue1 = new Catalogue($catalog);

# ***** DISPLAY

echo '<div class="container-full row ptblr-5 d-flex justify-content-around">';
displayCatalogue($Catalogue1);

echo '</div>';
include 'footer.php';