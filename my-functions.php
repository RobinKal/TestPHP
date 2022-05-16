<?php
function formatPrice($price)
{
    return $price / 100 . "€";
}
function priceExcludingVAT($TTCPrice){
    return $TTCPrice*100/(100+20);
}