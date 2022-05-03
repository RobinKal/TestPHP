<?php
$Oeufs = [
    "name" => "Oeufs x3",
    "price" => 3.99,
    "weight" => 300,
    "discount" => 0,
    "picture_url" => "https://www.framboizeinthekitchen.com/wp-content/uploads/2018/04/oeufs.jpg",
];
$Fromage = [
    "name" => "200gr Fromage",
    "price" => 4.49,
    "weight" => 200,
    "discount" => 10,
    "picture_url" => "https://www.pourquoidocteur.fr/media/article/istock-637341166-1522845538.jpg",
];
$Legumes = [
    "name" => "100gr Légumes",
    "price" => 3.19,
    "weight" => 100,
    "discount" => 20,
    "picture_url" => "https://img-3.journaldesfemmes.fr/HwUgYMFAXpGcR9A7Xrw4oF67Mf4=/1500x/smart/409e102e633d42759746f73e286431a3/ccmcms-jdf/11057068.jpg",
];
?>
<html>
<div>
    <h3><?php echo $Oeufs["name"]?></h3>
    <p>Prix : <?php echo $Oeufs["price"]?>€</p>
    <img src="<?php echo $Oeufs["picture_url"]?>" width="120" alt="Product picture">
</div>
<div>
    <h3><?php echo $Fromage["name"]?></h3>
    <p>Prix : <?php echo $Fromage["price"]?>€</p>
    <img src="<?php echo $Fromage["picture_url"]?>" width="120" alt="Product picture">
</div>
<div>
    <h3><?php echo $Legumes["name"]?></h3>
    <p>Prix : <?php echo $Legumes["price"]?>€</p>
    <img src="<?php echo $Legumes["picture_url"]?>" width="120" alt="Product picture">
</div>
</html>