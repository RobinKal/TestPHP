<?php
session_start();
include 'header.php';
require 'my-functions.php';
include ('catalog.php');
foreach($products as $product) : ?>
    <div class="d-flex justify-content-center p-2">
        <h3><?php echo $product["name"]?></h3>
        <p>Prix TTC : <?php echo formatPrice($product["price"])?></p>
        <p>Prix HT : <?php echo priceExcludingVAT($product["price"])?></p>
        <p><?php if($product["discount"] != NULL){
                echo "Discount : " . $product["discount"]. "% ";
            }
            echo " / " . discountedPrice($product["price"],$product["discount"]) . "€"?></p>
        <div class="row p-2">
            <form method="post" action="cart.php">
                <label for="Quantity">Quantité :</label>
                <input type="number" id="quantity" name="product_quantity" height="20"
                    min="0" max="1337" value="0">
                <input type="submit" name="product_name" value="<?=$product["name"]?>">
            </form>
        </div>
        <img class="m-2" src="<?php echo $product["picture_url"]?>" width="120" alt="Product picture">
    </div>
<?php
endforeach;
include 'footer.php';
?>