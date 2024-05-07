<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ComptesupprimerController extends AbstractController
{
    #[Route('/comptesupprimer', name: 'app_comptesupprimer')]
    public function index(): Response
    {
        return $this->render('comptesupprimer/index.html.twig', [
            'controller_name' => 'ComptesupprimerController',
        ]);
    }
}
