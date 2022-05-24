<?php
session_start();
include 'header.php';
require 'my-functions.php';
include ('catalog.php');
include('sql-queries.php');
include ('connect.php');

global $mysqlConnection;
$catalog = getAllProducts($mysqlConnection);
echo '<div class="container-full row ptblr-5 d-flex justify-content-around">';
foreach($catalog as $item) { ?>

    <div class="col-2 m-1 background">
        <div>
        <h3><?php echo $item["name"]?> <br></h3>
        <p>Prix TTC : <?php echo formatPrice($item["price"])?></p>
        <p>Prix HT : <?php echo priceExcludingVAT($item["price"])?></p>
        <p><?php if($item["discount"] != NULL){
                echo "Discount : " . $item["discount"]. "% ";
        echo " / " . discountedPrice($item["price"],$item["discount"]) . "€" ; }?></p>
            <p>Description produit : <?php echo $item["description"]?></p>


        <div class="row p-2">
            <form method="post" action="cart.php">
                <label for="Quantity">Quantité :</label>
                <input type="number" id="quantity" name="product_quantity" height="20"
                       min="0" max="1337" value="0">
                <input type="submit" name="product_id" value="<?=$item["id"]?>">
            </form>
            </div>
        <img class="m-2" src="<?php echo $item["url_image"]?>" width="120" height="120" alt="Product picture">
    </div>
</div>

<?php
}
echo '</div>';
include 'footer.php';
?>