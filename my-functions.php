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
function subTotalPrice($TTCPrice, $quantity){
    $subTotal = ($TTCPrice * $quantity) / 100;
    return number_format($subTotal,2) ;
}
function subTotalNoVAT($TTCPrice, $quantity){
    $subTotalVAT = ($TTCPrice * $quantity);
    $subTotalHT = (($subTotalVAT*100)/(100+20)) / 100;
    return number_format($subTotalHT, 2);
}
function totalVAT($TTCPrice, $HTPrice){
//    $totalVAT = (($TTCPrice * 20) / 100);
    $totalVAT = $TTCPrice - $HTPrice;
    return number_format($totalVAT, 2) . "€";
}