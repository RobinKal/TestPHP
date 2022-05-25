<?php
session_start();
include('header.php');
require 'my-functions.php';
include ('catalog.php');
include('sql-queries.php');
include ('connect.php');
emptyCart();
global $mysqlConnection;
$catalog = getAllProducts($mysqlConnection);


if(!isset($_SESSION["product_id"]) && !isset($_POST["product_id"])){
    echo '<h1>ERREUR DE COMMANDE</h1>';
}
elseif(!isset($_SESSION["product_id"])){
    $_SESSION["product_id"] = $_POST["product_id"];
    $_SESSION["product_quantity"] = $_POST["product_quantity"];
}
$orderProduct = getProductFromID($mysqlConnection,$_SESSION["product_id"]);
$_SESSION["name"] = $orderProduct[0]["name"];
$_SESSION["price"] = $orderProduct[0]["price"];
global $catalog;

?>


<div class="row col-6 d-flex p-5 justify-content-center">
<!--    --><?php //echo '<pre>',var_dump($orderProduct[0]),'</pre>';?>
    <?php
    if (!in_array($_SESSION["name"], $orderProduct[0])
        || $_SESSION["product_quantity"] < 0 || !is_numeric($_SESSION["product_quantity"]) )
    {?>

        <h1>ERREUR DE COMMANDE</h1>

    <?php
    } else {
        $totalVAT = totalVAT($orderProduct[0]["discount"],$orderProduct[0]["price"],$_SESSION["product_quantity"]);
        $totalWeight = shippingWeight($_SESSION["product_quantity"], $orderProduct[0]["weight"]);
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
                <td><?= $_SESSION["name"] ?></td>
                <td><?= priceExcludingVAT($orderProduct[0]["price"]) ?></td>
                <td><?= formatPrice($orderProduct[0]["price"]) ?></td>
                <td><?= $_SESSION["product_quantity"] ?></td>
                <td><?= subTotalPrice($orderProduct[0]["price"], $_SESSION["product_quantity"]) . "€" ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total HT</td>
                <td><?= subTotalNoVAT($orderProduct[0]["price"], $_SESSION["product_quantity"]) . "€" ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>TVA</td>
                <td><?= totalDiscountedVAT(subTotalPrice($orderProduct[0]["price"], $_SESSION["product_quantity"]), subTotalNoVAT($orderProduct[0]["price"], $_SESSION["product_quantity"])) ?></td>
            </tr>
            <tr>
                <td>Discounted price :</td>
                <td><?= discountedPrice($orderProduct[0]["price"],$orderProduct[0]["discount"]) . "€" ?></td>
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
                <td>
                    <?php if(isset($_POST["shippingOption"])) {
                    $totalWshipping = totalWithShipping($_POST["shippingOption"], $totalWeight, $totalVAT);
                    $_SESSION['totalTTC'] = $totalWshipping * 100;
                       echo $totalWshipping . "€";
                    }else {
                        echo "Please select a shipping method";
                    }

                    ?> </td>
            </tr>
        </table>
    <?php
    }
    ?>
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
    <input type="submit" name="shipping_option" value="Select shipping">
    </div>
</form>
<form method="get" action="cart.php">
    <input type="submit" name="clear" value="clear cart">
</form>
<?php
if(isset($_POST["shippingOption"])) { ?>
    <form method = "post" action = "validation_order.php" >
    <input type = "hidden" name = "validate" value = "validate" >
        <button type="submit">COMMANDER</button>
</form >
    <?php }
include('footer.php')?>