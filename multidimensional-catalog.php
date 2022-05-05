<?php
include 'header.php';
require 'my-functions.php';
$products = [
    "Oeufs" => [
        "name" => "Oeufs x3",
        "price" => 399,
        "weight" => 300,
        "discount" => 0,
        "picture_url" => "https://www.framboizeinthekitchen.com/wp-content/uploads/2018/04/oeufs.jpg",
    ],
    "Fromage" =>[
        "name" => "200gr Fromage",
        "price" => 449,
        "weight" => 200,
        "discount" => 10,
        "picture_url" => "https://www.pourquoidocteur.fr/media/article/istock-637341166-1522845538.jpg",
    ],
    "Legumes" =>[
        "name" => "100gr Légumes",
        "price" => 319,
        "weight" => 100,
        "discount" => 20,
        "picture_url" => "https://img-3.journaldesfemmes.fr/HwUgYMFAXpGcR9A7Xrw4oF67Mf4=/1500x/smart/409e102e633d42759746f73e286431a3/ccmcms-jdf/11057068.jpg",
    ]
];
?>
<html lang="EN">
<?php foreach($products as $key) : ?>
    <div class="d-flex justify-content-center p-2">
         <h3><?php echo $key["name"]?></h3>
    <p>Prix TTC : <?php echo formatPrice($key["price"])?></p>
        <p>Prix HT : <?php echo priceExcludingVAT($key["price"])?></p>
        <p>Discount : <?php echo $key["discount"]. "% / " . discountedPrice($key["price"],$key["discount"])?></p>
        <div class="row p-2">
         <form method="get">
        <label for="Quantity">Quantité :</label>
        <input type="number" id="quantity" name="product_quantity" height="20"
               min="0" max="1337" value="0">
             <input type="submit" name="product_name" value="<?=$key["name"]?>">
        </div>
        </form>
        <img class="m-2" src="<?php echo $key["picture_url"]?>" width="120" alt="Product picture">

</div>
    <?php endforeach; ?>
</html>
<?php include 'footer.php'; ?>
<!--<html lang="EN">-->
<!--<div>-->
<!--    <h3>--><?php //echo $products["Oeufs"]["name"]?><!--</h3>-->
<!--    <p>Prix : --><?php //echo $products["Oeufs"]["price"]?><!--€</p>-->
<!--    <img src="--><?php //echo $products["Oeufs"]["picture_url"]?><!--" width="120" alt="Product picture">-->
<!--</div>-->
<!--<div>-->
<!--    <h3>--><?php //echo $products["Fromage"]["name"]?><!--</h3>-->
<!--    <p>Prix : --><?php //echo $products["Fromage"]["price"]?><!--€</p>-->
<!--    <img src="--><?php //echo $products["Fromage"]["picture_url"]?><!--" width="120" alt="Product picture">-->
<!--</div>-->
<!--<div>-->
<!--    <h3>--><?php //echo $products["Legumes"]["name"]?><!--</h3>-->
<!--    <p>Prix : --><?php //echo $products["Legumes"]["price"]?><!--€</p>-->
<!--    <img src="--><?php //echo $products["Legumes"]["picture_url"]?><!--" width="120" alt="Product picture">-->
<!--</div>-->
<!--</html>-->