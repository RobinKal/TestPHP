<?php
$products = ["Oeuf",
    "Fromage",
    "Légumes",
    ];
sort($products);
var_dump($products);
for ($i = 0; $i < count($products); $i++) {
    echo "$products[$i]\n";
    }
echo $products[0],"/", $products[2];
//echo $products[2];