<?php
function formatPrice($price)
{
    return $price / 100 . "€";
}
function priceExcludingVAT($TTCPrice){
    $HTPrice = (($TTCPrice*100)/(100+20)) / 100;
    return number_format($HTPrice, 2) . "€";
}
function discountedPrice($TTCPrice, $discount){
    $TTCPrice = ($TTCPrice - ($TTCPrice*$discount/100)) / 100;
    return number_format($TTCPrice, 2) . "€";
}