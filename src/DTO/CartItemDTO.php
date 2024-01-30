<?php
namespace App\DTO;

use App\Entity\Products;

final class CartItemDTO 
{
    private Products $products;
    private int $quantitySale = 1;

    public function setProduct(Products $products): void
    {
        $this->products = $products;
    }
    public function getProduct(): Products
    {
        return $this->products;
    }

    public function setQuantitySale(int $quantitySale): void
    {
        $this->quantitySale = $quantitySale;
    }

    public function getQuantitySale(): int
    {
        return $this->quantitySale;
    }
}