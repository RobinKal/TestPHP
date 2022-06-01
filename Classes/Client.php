<?php
//include('Item.php');
include_once __DIR__ . '/../connect.php';
require_once __DIR__ . '/../my-functions.php';
include_once __DIR__ . '/../sql-queries.php';
global $mysqlConnection;

class Client
{
    private int $id;
    private string $last_name;
    private string $first_name;
    private string $address;
    private string $city;
    private int $zip_code;

    public function __construct(array $ClientsList)
    {
        $this->id = $ClientsList["id"];
        $this->last_name = $ClientsList["last_name"];
        $this->first_name = $ClientsList["first_name"];
        $this->address = $ClientsList["address"];
        $this->city = $ClientsList["city"];
        $this->zip_code = $ClientsList["zip_code"];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZipCode(): int
    {
        return $this->zip_code;
    }


}
