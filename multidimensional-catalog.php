<?php
include 'header.php';
require 'my-functions.php';
include ('catalog.php');

?>
<html lang="EN">
<?php foreach($products as $key) : ?>
    <div class="d-flex justify-content-center p-2">
         <h3><?php echo $key["name"]?></h3>
    <p>Prix TTC : <?php echo formatPrice($key["price"])?></p>
        <p>Prix HT : <?php echo priceExcludingVAT($key["price"])?></p>
        <p>Discount : <?php echo $key["discount"]. "% / " . discountedPrice($key["price"],$key["discount"])?></p>
        <div class="row p-2">
         <form method="get" action="cart.php">
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