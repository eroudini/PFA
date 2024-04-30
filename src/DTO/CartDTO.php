<?php
namespace App\DTO;
use App\Entity\Product;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

final class CartDTO 
{
    private array $cart;
    private ArrayCollection $sales;
    public function __construct()
    {
        $this->sales = new ArrayCollection();
    }

    public function initializeCart(): void
    {
        $products = [];
        foreach ($this->getSales() as $sale)
        {
            $products[] = $sale->getProduct();
        }
        $this->cart = $products;
    }
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @return Collection<int, CartItemDTO>
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addProduct(CartItemDTO $sale): static
    {
        if (!$this->sales->contains($sale)) {
            $this->sales->add($sale);
        }
        $this->initializeCart();
        return $this;
    }

    public function removeProduct(CartItemDTO $sale): static
    {
        $this->sales->removeElement($sale);
        $this->initializeCart();
        return $this;
    } 
}
