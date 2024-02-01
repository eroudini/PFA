<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ContactRepository;
use App\Repository\ProductsRepository;
use App\Repository\VoituresRepository;
use App\Repository\AcontacterRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(
    ProductsRepository $products, 
    UserRepository $Users, VoituresRepository $voitures,
    ContactRepository $contact,
    AcontacterRepository $acontacter,
    ): Response

    {

        $Users = $Users->findAll();
        
        return $this->render('admin/adminnav.html.twig', [
            'controller_name' => 'AdminController',
            'Users' => $Users,
        ]);
    }
}




    // #[Route('/admin', name: 'admin')]
    // public function index(ProductsRepository $products, 
    // UserRepository $Users, VoituresRepository $voitures,
    // ContactRepository $contact,
    // AcontacterRepository $acontacter,
    
    // ): Response
    // {
    //     return $this->render('dashboard.html.twig', [
    //         'Users' => $Users->findBy([], ['categoryOrder' => 'asc'])
    //     ]);
    // }

