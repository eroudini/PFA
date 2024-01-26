<?php

namespace App\Controller;

use App\Entity\Products;

use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'app_product', methods: ['GET'])]
    public function index(ProductsRepository $products, Request $request): Response
    {
  

        $products = $products->findAll();
        
        return $this->render("product/details.html.twig", [
            'products' => $products
        ]);}

    // #[Route('/{slug}', name: 'details')]
    // public function details(ProductsRepository $ProductsRepository): Response
    // {
    //     return $this->render("product/details.html.twig", compact('product'));
            
    }    
