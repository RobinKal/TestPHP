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

    function __construct($id, $name, $price, $available)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->available = $available;
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

$coteDeBoeuf = new Item(1,'cote de boeuf', 10500, true);
$coteDeBoeuf->imageUrl = 'http://www.maison-lascours.fr/Files/123193/Img/03/cote-de-boeuf-simmental-big.jpg';
$coteDeBoeuf->stock = 30;
$coteDeBoeuf->weight = 1000;
$coteDeBoeuf->discount = NULL;
$coteDeBoeuf->description = 'miam miam';
