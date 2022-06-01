<?php
function formatPrice($price)
{
    return $price / 100 . "€";
}

function priceExcludingVAT($TTCPrice)
{
    $HTPrice = (($TTCPrice * 100) / (100 + 20)) / 100;
    return number_format($HTPrice, 2) . "€";
}

function discountedPrice($TTCPrice, $discount)
{
    $TTCPrice = ($TTCPrice - ($TTCPrice * $discount / 100)) / 100;
    return number_format($TTCPrice, 2);
}

function subTotalPrice($TTCPrice, $quantity)
{
    $subTotal = ($TTCPrice * $quantity) / 100;
    return number_format($subTotal, 2);
}

function subTotalNoVAT($TTCPrice, $quantity)
{
    $subTotalVAT = ($TTCPrice * $quantity);
    $subTotalHT = (($subTotalVAT * 100) / (100 + 20)) / 100;
    return number_format($subTotalHT, 2);
}

function totalDiscountedVAT($TTCPrice, $HTPrice)
{
//    $totalVAT = (($TTCPrice * 20) / 100);
    $totalVAT = $TTCPrice - $HTPrice;
    return number_format($totalVAT, 2) . "€";
}

function shippingWeight($quantity, $weight)
{
    return $quantity * $weight;
}

function shippingPrice($TTCPrice, $percentage)
{
    return number_format($TTCPrice * $percentage / 100, 2);
}

function totalVAT($discount, $TTCPrice, $quantity)
{
    if ($discount != NULL) {
        return number_format(discountedPrice($TTCPrice, $discount) * $quantity, 2);
    } else {
        return number_format(subTotalPrice($TTCPrice, $quantity), 2);
    }
}

function emptyCart()
{
    if (isset($_GET["clear"])) {
        $_SESSION = [];
    }
}

function totalWithShipping($shippingOption, $totalWeight, $totalVAT)
{
    if ($totalWeight <= 500) {
        if ($shippingOption === "laposte") {
            $totalTTCWithShipping = $totalVAT + 3;
            return $totalTTCWithShipping;
        } elseif ($shippingOption === "ups") {
            $totalTTCWithShipping = $totalVAT + 5;
            return $totalTTCWithShipping;
        }
    } elseif ($totalWeight <= 1000) {
        if ($shippingOption === "laposte") {
            $totalTTCWithShipping = $totalVAT + shippingPrice($totalVAT, 5);
            return $totalTTCWithShipping;
        } elseif ($shippingOption === "ups") {
            $totalTTCWithShipping = $totalVAT + shippingPrice($totalVAT, 10);
            return $totalTTCWithShipping;
        }
    } elseif ($totalWeight > 1000) {
        $totalTTCWithShipping = $totalVAT;
        return $totalTTCWithShipping;
    }
}

function displayItem(Item $item)
{
    ?>
    <div class="col-2 m-1 background">
        <div>
            <h3><?php echo $item->name ?> <br></h3>
            <p>Prix TTC : <?php echo formatPrice($item->price) ?></p>
            <p>Prix HT : <?php echo priceExcludingVAT($item->price) ?></p>
            <p><?php if ($item->discount != NULL) {
                    echo "Discount : " . $item->discount . "% ";
                    echo " / " . discountedPrice($item->price, $item->discount) . "€";
                } ?></p>
            <p>Description produit : <?php echo $item->description ?></p>
            <img class="m-2" src="<?php echo $item->imageUrl ?>" width="120" height="120" alt="Product picture">
            <div class="row p-2">
                <form method="post" action="cart.php">
                    <label for="quantity">Quantité :</label>
                    <input type="number" id="quantity" name="product_quantity" height="20"
                           min="0" max="1337" value="">
                    <input type="hidden" name="product_id" value="<?php $item->id ?>">
                    <button type="submit">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
<?php }

function displayCatalogue(Catalogue $Catalogue1)
{
    foreach ($Catalogue1 as $items) {
        foreach ($items as $item) {
                ?>
                <div class="col-2 m-1 background">
                    <div>
                        <h3><?php echo $item->name ?> <br></h3>
                        <p>Prix TTC :
                            <?php echo formatPrice($item->price) ?></p>
                        <p>Prix HT : <?php echo priceExcludingVAT($item->price) ?></p>
                        <p><?php if ($item->discount != NULL) {
                                echo "Discount : " . $item->discount . "% ";
                                echo " / " . discountedPrice($item->price, $item->discount) . "€";
                            } ?></p>
                        <p>Description produit : <?php echo $item->description ?></p>
                        <img class="m-2" src="<?php echo $item->imageUrl ?>" width="120" height="120"
                             alt="Product picture">
                        <div class="row p-2">
                            <form method="post" action="cart.php">
                                <label for="quantity">Quantité :</label>
                                <input type="number" id="quantity" name="product_quantity" height="20"
                                       min="0" max="1337" value="">
                                <input type="hidden" name="product_id" value="<?php echo $item->getId() ?>">
                                <button type="submit">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }
        }
}