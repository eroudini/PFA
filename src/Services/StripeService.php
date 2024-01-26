<?php 
namespace App\Services;

use App\Repository\ProductsRepository;
use Stripe\StripeClient;

class StripeService
{
    private StripeClient $stripe;

    public function createProduct(ProductsRepository $product): \Stripe\Product
    {
        return $this->stripe->products->create([
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'active' => $product->getActive()


        ]);
    }

    private function getStripe(): StripeClient
    {
        return $this->stripe ??= new StripeClient($_ENV('STRIPE_SECRET'));
    }
}
