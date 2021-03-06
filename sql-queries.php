<?php



// Functions
function getProductFromID($mysqlConnection, $productID){
    $sqlQuery = 'SELECT name, price, weight, discount FROM products WHERE products.id = :productID';
    $product = $mysqlConnection->prepare($sqlQuery);
    $product -> bindValue(':productID', $productID, PDO::PARAM_INT);
    $product->execute();
    return $product -> fetchAll(PDO::FETCH_ASSOC);
}

function getAllProducts($mysqlConnection){
    $sqlQuery = 'SELECT * FROM products';
    $productlist = $mysqlConnection->prepare($sqlQuery);
    $productlist -> execute();
    return $productlist -> fetchAll(PDO::FETCH_ASSOC);
}

function getAllClients($mysqlConnection){
    $sqlQuery = 'SELECT * FROM customers';
    $clientlist = $mysqlConnection->prepare($sqlQuery);
    $clientlist -> execute();
    return $clientlist -> fetchAll(PDO::FETCH_ASSOC);
}

function getAvailableProducts($mysqlConnection){
    $sqlQuery = 'SELECT * FROM products WHERE available = 1';
    $listProducts = $mysqlConnection->prepare($sqlQuery);
    $listProducts -> execute();
return $listProducts ->fetchAll(PDO::FETCH_ASSOC);
}

function getTodayOrders($mysqlConnection){
    $sqlQuery = 'SELECT * from orders where DATE(date)=curdate() ORDER BY number DESC;';
    $listOrders = $mysqlConnection->prepare($sqlQuery);
    $listOrders->execute();
    return $listOrders->fetchAll(PDO::FETCH_ASSOC);
}

function getOrderProduct( $mysqlConnection, $ID){
    $sqlQuery = 'SELECT name, order_product.quantity, price 
        from products
        INNER JOIN order_product ON products.id = product_id
        where order_product.order_id= :id;';
    $productFromOrder = $mysqlConnection->prepare($sqlQuery);
    $productFromOrder-> bindValue(':id', $ID, PDO::PARAM_INT);
    $productFromOrder-> execute();
    return $productFromOrder->fetchAll(PDO::FETCH_ASSOC);
}

function sumOrdersByDate($mysqlConnection, $date){
    $sqlQuery = 'SELECT 
SUM(products.price * order_product.quantity) total
from order_product
INNER JOIN orders ON orders.id = order_id
INNER JOIN products ON products.id = product_id
WHERE DATE(date)= :date ;';
    $listOrders = $mysqlConnection-> prepare($sqlQuery);
    $listOrders -> execute(array('date' => $date));
    return $listOrders->fetchAll(PDO::FETCH_ASSOC);
}

function deleteUsersWNoOrders($mysqlConnection){
    $sqlQuery = 'DELETE FROM customers
        WHERE id NOT IN(SELECT customer_id FROM orders);';
    $listUsers = $mysqlConnection -> prepare($sqlQuery);
    $listUsers -> execute();
    return $listUsers -> fetchAll(PDO::FETCH_ASSOC);
}

function addQty( $mysqlConnection, $qty, $productID){
    $sqlQuery = 'UPDATE products
        SET quantity = quantity + :qty
        WHERE id = :productID;';
    $listItem = $mysqlConnection -> prepare($sqlQuery);
    $listItem -> bindValue(':qty', $qty, PDO::PARAM_INT);
    $listItem -> bindValue(':productID', $productID, PDO::PARAM_INT);
    $listItem -> execute();
    return $listItem -> fetchAll(PDO::FETCH_ASSOC);
}

function changePrice($mysqlConnection, $price, $productID){
    $sqlQuery = 'UPDATE products
        SET price = price + :price
        WHERE id = :productID;';
    $listItem = $mysqlConnection -> prepare($sqlQuery);
    $listItem -> bindValue(':price', $price, PDO::PARAM_INT);
    $listItem -> bindValue(':productID', $productID, PDO::PARAM_INT);
    $listItem -> execute();
    return $listItem -> fetchAll(PDO::FETCH_ASSOC);
}

function getOrderByNum($mysqlConnection, $orderNum){
    $sqlQuery = 'SELECT products.name, products.price, order_product.quantity, SUM(products.price * order_product.quantity) as total
        FROM orders
        LEFT JOIN order_product ON orders.id = order_id
        LEFT JOIN products ON products.id = product_id
        WHERE number = :number
        GROUP BY product_id;';
    $listProducts = $mysqlConnection -> prepare($sqlQuery);
    $listProducts -> bindValue('number', $orderNum, PDO::PARAM_INT);
    $listProducts -> execute();
    return $listProducts -> fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByCat($mysqlConnection, $cat){
    $sqlQuery = 'SELECT products.name, price, products.description, weight, url_image
        FROM products
        LEFT JOIN categories ON categories_id = categories.id
        WHERE categories_id = :cat;';
    $listProducts = $mysqlConnection -> prepare($sqlQuery);
    $listProducts -> bindValue('cat', $cat, PDO::PARAM_INT);
    $listProducts -> execute();
    return $listProducts -> fetchAll(PDO::FETCH_ASSOC);
}

function getOrdersByClient($mysqlConnect, $last_name){
    $sqlQuery = 'SELECT number FROM orders
        LEFT JOIN customers ON customer_id = customers.id
        WHERE customers.last_name = :last_name;';
    $listNum = $mysqlConnect -> prepare($sqlQuery);
    $listNum -> bindValue('last_name', $last_name, PDO::PARAM_STR);
    $listNum -> execute();
    return $listNum -> fetchAll(PDO::FETCH_ASSOC);
}

function placeOrder($mysqlConnection, $total){
    $sqlQuery = "INSERT INTO orders(date,total,customer_id)
VALUES (curdate(), '$total', 2);";
    $mysqlConnection -> prepare($sqlQuery) -> execute();
}
