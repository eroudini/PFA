<?php

namespace App\Controller;

use App\Repository\NosVehiculesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculesController extends AbstractController
{
    #[Route('/vehicules', name: 'vehicules')]
    // Function qui fait appel au repository
    public function index(NosVehiculesRepository $nosVehiculesRepository): Response
    {
        // declaration de la vatiable vehicles
        $vehicules = $nosVehiculesRepository->findAll();
        // retour du rendu dans le twig
        return $this->render('vehicules.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }

}
