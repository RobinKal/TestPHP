<?php
session_start();
include_once ('header.php');
include('sql-queries.php');
include ('connect.php');
global $mysqlConnection;

if (!isset($_POST['validate'])){
    echo 'VOTRE COMMANDE N\'EST PAS VALIDE';
}else{
?>
<h1>VOTRE COMMANDE EST VALIDÉ</h1>
<pre><?php
    placeOrder($mysqlConnection, $_SESSION['totalTTC']);

}
echo '</pre>' , var_dump($_SESSION) , '</pre>';

include_once ('footer.php');