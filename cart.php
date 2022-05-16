<?php
session_start();
include('header.php');
require 'my-functions.php';
include ('catalog.php');
emptyCart();
if(!isset($_SESSION["product_name"]) && !isset($_POST["product_name"])){
    echo '<h1>ERREUR DE COMMANDE</h1>';
}
elseif(!isset($_SESSION["product_name"])){
    $_SESSION["product_name"] = $_POST["product_name"];
    $_SESSION["product_quantity"] = $_POST["product_quantity"];
}

?>
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
    <?php if (!in_array($_SESSION["product_name"], array_keys($products))  || $_SESSION["product_quantity"] < 0 || !is_numeric($_SESSION["product_quantity"]) ){?>
        <h1>ERREUR DE COMMANDE</h1>
    <?php } else {
        $totalVAT = totalVAT($products[$_SESSION["product_name"]]["discount"],$products[$_SESSION["product_name"]]["price"],$_SESSION["product_quantity"]);
        $totalWeight = shippingWeight($_SESSION["product_quantity"], $products[$_SESSION["product_name"]]["weight"]);
        ?>
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
                <td><?= $_SESSION["product_name"] ?></td>
                <td><?= priceExcludingVAT($products[$_SESSION["product_name"]]["price"]) ?></td>
                <td><?= formatPrice($products[$_SESSION["product_name"]]["price"]) ?></td>
                <td><?= $_SESSION["product_quantity"] ?></td>
                <td><?= subTotalPrice($products[$_SESSION["product_name"]]["price"], $_SESSION["product_quantity"]) . "€" ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total HT</td>
                <td><?= subTotalNoVAT($products[$_SESSION["product_name"]]["price"], $_SESSION["product_quantity"]) . "€" ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>TVA</td>
                <td><?= totalDiscountedVAT(subTotalPrice($products[$_SESSION["product_name"]]["price"], $_SESSION["product_quantity"]), subTotalNoVAT($products[$_SESSION["product_name"]]["price"], $_SESSION["product_quantity"])) ?></td>
            </tr>
            <tr>
                <td>Discounted price :</td>
                <td><?= discountedPrice($products[$_SESSION["product_name"]]["price"],$products[$_SESSION["product_name"]]["discount"]) . "€" ?></td>
                <td></td>
                <td>Total TTC</td>
                <td><?php echo $totalVAT . "€"; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total Weight</td>
                <td><?php echo $totalWeight ?> GR</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total with shipping</td>
                <td><?php if(isset($_POST["shippingOption"])) {
                       echo totalWithShipping($_POST["shippingOption"], $totalWeight, $totalVAT) . "€";
                    }else {
                        echo "Please select a shipping method";
                    }

                    ?> </td>
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
        <select name="shippingOption" id="shippingO" class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option name="LAPOSTE" value="laposte">
                <?php if($totalWeight <= 500){ ?>
                    La Poste - 3 €
                <?php } elseif($totalWeight <= 1000) {?>
                    La Poste -
                <?php  echo shippingPrice($totalVAT, 5) . "€";
                } else { ?>
                    La Poste - GRATUIT
                <?php } ?>
            </option>
            <option name="UPS" value="ups">
                <?php if($totalWeight <= 500){ ?>
                    UPS - 5 €
                <?php }elseif($totalWeight <= 1000) {?>
                    UPS -
                <?php  echo shippingPrice($totalVAT, 10) . "€";
                } else { ?>
                    UPS - GRATUIT
                <?php } ?>
            </option>
        </select>
    <input type="submit" name="shipping_option" value="Commander">
    </div>
</form>
<form method="get" action="cart.php">
    <input type="submit" name="clear" value="clear cart">
</form>
<?= include('footer.php')?>