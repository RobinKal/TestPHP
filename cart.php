<?php
include('header.php');
require 'my-functions.php';
include ('catalog.php');
var_dump($_GET["product_name"]);
?>
<html lang="FR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Exemple d'une page produit telle qu'elles seront disponibles sur notre site">
    <meta name="keywords" content="Oeufs, Produit locaux, Nom producteur">
    <meta name="author" content="Robin">
    <title>Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="Styles/stylecart.css" rel="stylesheet">
</head>
<div class="d-flex justify-content-center p-2">
    <?php if ($_GET["product_name"] != "Oeufsx3" || $_GET["product_name"] != "200gr Fromage" || $_GET["product_name"] != "100gr Legumes" && $_GET["product_quantity"] < 0 || is_numeric($_GET["product_quantity"]) === FALSE ){?>
        <h1>ERREUR DE COMMANDE</h1>
    <?php } else { ?>
        <h1>PANIER</h1>
        <table>
            <tr>
                <th>Produit</th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
            <tr>
                <td><?= $_GET["product_name"] ?></td>
                <td><?= priceExcludingVAT($products[$_GET["product_name"]]["price"]) ?></td>
                <td><?= formatPrice($products[$_GET["product_name"]]["price"]) ?></td>
                <td><?= $_GET["product_quantity"] ?></td>

                <td><?= subTotalPrice($products[$_GET["product_name"]]["price"], $_GET["product_quantity"]) . "€" ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total HT</td>
                <td><?= subTotalNoVAT($products[$_GET["product_name"]]["price"], $_GET["product_quantity"]) . "€" ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>TVA</td>
                <td><?= totalVAT(subTotalPrice($products[$_GET["product_name"]]["price"], $_GET["product_quantity"]), subTotalNoVAT($products[$_GET["product_name"]]["price"], $_GET["product_quantity"])) ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total TTC</td>
                <td><?= subTotalPrice($products[$_GET["product_name"]]["price"], $_GET["product_quantity"],) . "€" ?></td>
            </tr>
        </table>


    <?php } ?>
</div>
</html>
<?= include('footer.php');?>