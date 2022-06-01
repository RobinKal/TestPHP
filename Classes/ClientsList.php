<?php
include_once __DIR__ . '/../connect.php';
global $mysqlConnection;


class ClientsList
{
    public array $listOfClients = [];

    public function __construct($ClientsList)
    {

        foreach ($ClientsList as $Clients) {
            $this->listOfClients[] = new Client($Clients);

        }
    }

}
