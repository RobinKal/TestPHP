<?php
include('header.php');
?>
<html lang="FR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Exemple d'une page produit telle qu'elles seront disponibles sur notre site">
    <meta name="keywords" content="Oeufs, Produit locaux, Nom producteur">
    <meta name="author" content="Samantha">
    <title>Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="Styles/stylecart.css" rel="stylesheet">
</head>
<div class="d-flex justify-content-center p-2">
<h1>PANIER</h1>
    <table>
            <tr>
                <th><?= $_GET["product_name"] ?></th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>

            <tr>
                <td>Carmen</td>
                <td>33 ans</td>
                <td>Espagne</td>
                <td>Espagne</td>
                <td>Espagne</td>
            </tr>
            <tr>
                <td>Michelle</td>
                <td>26 ans</td>
                <td>États-Unis</td>
            </tr>
    </table>
</div>
</html>
<?= include('footer.php');?>