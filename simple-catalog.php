<?php
$products = ["Oeuf",
    "Fromage",
    "Légumes",
    ];
sort($products);
for ($i = 0; $i < count($products); $i++) {
    echo "$products[$i]\n";
    }
//echo $products[0],"/", $products[2];
//echo $products[2];