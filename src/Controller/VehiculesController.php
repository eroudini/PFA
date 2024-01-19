<?php

namespace App\Controller;

use App\Repository\NosVehiculesRepository;
use App\Repository\VoituresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculesController extends AbstractController
{
    #[Route('/vehicules', name: 'vehicules')]
    // Function qui fait appel au repository
    public function index(VoituresRepository $VoituresRepository): Response
    {
        // declaration des variables
        $vehicules = $VoituresRepository->findAll();
        
        // retour du rendu dans le twig
        return $this->render('vehicules.html.twig', [
            'vehicules' => $vehicules,
                             
        ]);
        
    }

}
