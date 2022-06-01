<?php

class Item
{
    public int $id;
    public string $name;
    public string $description;
    public string $imageUrl;
    public int $weight;
    public int $stock;
    public int $price;
    public ?int $discount;
    public bool $available;

    function __construct($Catalogue)
    {
        $this->id = $Catalogue['id'];
        $this->name = $Catalogue['name'];
        $this->description = $Catalogue['description'];
        $this->imageUrl = $Catalogue['imageUrl'];
        $this->weight = $Catalogue['weight'];
        $this->stock = $Catalogue['stock'];
        $this->price = $Catalogue['price'];
        $this->discount = $Catalogue['discount'];
        $this->available = $Catalogue['available'];
    }

    public function setDiscount(mixed $discount): void
    {
        $this->discount = $discount;
    }

    public function getId() : int
    {
        return $this->id;
    }

    function getInfo() : array
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'weight' => $this->weight,
            'available' => $this->available,
            'description' => $this->description,
            'imageUrl' => $this->imageUrl,
            'stock' => $this->stock
        ) ;
    }
}