<?php
//include('Item.php');
include __DIR__. ('/../../connect.php');
require __DIR__. ('/../../my-functions.php');
include __DIR__. ('/../../sql-queries.php');
global $mysqlConnection;
$catalog = getAllProducts($mysqlConnection);

class Catalogue
{
    public array $listOfItems = [];

    public function __construct($catalog)
    {
        $this->listOfItems[] = $catalog;
    }
}
