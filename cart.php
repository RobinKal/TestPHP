<?php
include('header.php');
require 'my-functions.php';
include ('catalog.php');
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
<div class="row col-6 d-flex p-5 justify-content-center">
    <?php if (!in_array($_GET["product_name"], array_keys($products))  || $_GET["product_quantity"] < 0 || !is_numeric($_GET["product_quantity"]) ){?>
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
                <td>Discounted price :</td>
                <td><?= discountedPrice($products[$_GET["product_name"]]["price"],$products[$_GET["product_name"]]["discount"]) . "€" ?></td>
                <td>TVA</td>
                <td><?= totalDiscountedVAT(subTotalPrice($products[$_GET["product_name"]]["price"], $_GET["product_quantity"]), subTotalNoVAT($products[$_GET["product_name"]]["price"], $_GET["product_quantity"])) ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total TTC</td>
                <td><?php echo totalVAT($products[$_GET["product_name"]]["discount"], $products[$_GET["product_name"]]["price"], $_GET["product_quantity"]) . "€"; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total Weight</td>
                <td><?php echo shippingWeight($_GET["product_quantity"], $products[$_GET["product_name"]]["weight"] ) ?> GR</td>
            </tr>
        </table>
    <?php } ?>
</div>
<form method="post">
<div class="row d-flex p-2 justify-content-center">
    <br>
    <h3 class="p2">Select shipping :<br></h3>
    <p><strong>La Poste :</strong> 2 jours à 3 semaines <br>
        ● de 0 à 500g : 3 euros de frais de port<br>
        ● de 500g à 1kg : 5% du montant total de frais de port<br>
        ● >1kg : frais de port gratuits<br>
    </p>
    <p><strong>UPS :</strong> 2 jours à 3jours ouvrés<br>
        ● de 0 à 500g : 5 euros de frais de port<br>
        ● de 500g à 1kg : 10% du montant total de frais de port<br>
        ● >1kg : frais de port gratuits<br>
    </p>
</div>
<div class="col-4 d-flex p-2">
    <select class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option value="1"><?php if(shippingWeight($_GET["product_quantity"], $products[$_GET["product_name"]]["weight"] ) <= 500){ ?>La Poste - 3 €
    <?php }elseif(shippingWeight($_GET["product_quantity"], $products[$_GET["product_name"]]["weight"]) <= 1000) {?>
                La Poste - <?php  echo shippingPrice(totalVAT($products[$_GET["product_name"]]["discount"],$products[$_GET["product_name"]]["price"],$_GET["product_quantity"] ), 5) . "€";?>
        <?php } else {
            echo "La Poste - GRATUIT";} ?>
    </option>
        <option value="2"><?php if(shippingWeight($_GET["product_quantity"], $products[$_GET["product_name"]]["weight"] ) <= 500){ ?>UPS - 5 €
            <?php }elseif(shippingWeight($_GET["product_quantity"], $products[$_GET["product_name"]]["weight"]) <= 1000) {?>
                UPS - <?php  echo shippingPrice(totalVAT($products[$_GET["product_name"]]["discount"],$products[$_GET["product_name"]]["price"],$_GET["product_quantity"] ), 10) . "€";?>
            <?php } else {
                echo "UPS - GRATUIT";} ?></option>
    </select>
    <input type="submit" name="shipping_option" value="Commander">
</div>
</form>
</html>
<?= include('footer.php');?>