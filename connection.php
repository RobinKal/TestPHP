<?php
include('database.php');
try {
// On se connecte à MySQL
$mysqlConnection = new PDO(
    'mysql:host=localhost;dbname=amazen;charset=utf8',
    'robin_kalck',
    'test321'
);
}
// En cas d'erreur, on affiche un message et on arrête tout, autrement on continue
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}
// Récupère tout le contenu de la table products

$availableProducts = getAvailableProducts($mysqlConnection);
foreach ($availableProducts as $productTable){
    foreach ($productTable as $product => $value){
        ?>
        <p><?php echo $product . ": " . $value;?></p>

<?php
    }
}
$request = sumOrdersByDate($mysqlConnection, '2022-05-19');
echo '<pre>' , var_dump($request) , '</pre>';
?>
<link href="./style.css" rel="stylesheet">
<form method="post">
    <div>
        <label for="change_quantity">Quantité à ajouter ou enlever :</label>
        <input id="change_quantity" type="number" name="change_quantity" required>
        <span class="validity"></span>
        <label for="quantity_id">ID du produit à modifier :</label>
        <input id="quantity_id" type="number" name="quantity_id" required>
        <span class="validity"></span>
    </div>
    <div>
        <input type="submit">
    </div>
</form>
<?php
if(isset($_POST['change_quantity'])){
    addQty($mysqlConnection, $_POST['change_quantity'], $_POST['quantity_id']);
} ?>
<form method="post">
    <div>
        <label for="change_price">Prix à ajouter ou enlever :</label>
        <input id="change_price" type="number" name="change_price" required>
        <span class="validity"></span>
        <label for="price_id">ID du produit à modifier :</label>
        <input id="price_id" type="number" name="price_id" required>
        <span class="validity"></span>
    </div>
    <div>
        <input type="submit">
    </div>
</form>
<?php
if (isset($_POST['change_price'])){
    changePrice($mysqlConnection, $_POST['change_price'], $_POST['price_id']);
}
