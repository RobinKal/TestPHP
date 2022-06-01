<?php

class Shoes extends Item
{
    public int $size;

    function __construct(array $catalog ,int $shoeSize)
    {
        parent::__construct($catalog);
        $this->size = $shoeSize;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }
}