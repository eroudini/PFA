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

    // Interoge SQL

    // public function findVehicules(): array
    // {
    //     $vehicules = $this->getEntityManager()->findAll();

    //     $sql = "SELECT * FROM vehicules";

    //     $resultSet = $marques->executeQuery($sql, ["vehicules" => $vehicules]);
    // }

    // // Recup des objets

    // public function show(EntityManagerInterface $entityManager, int $id_vehicules): Response
    // {
    //     $vehicules = $entityManager->getRepository(vehicules::class)->find($id_vehicules);

    //     if (!$vehicules) {
    //         throw $this->createNotFoundException('Je trouve pas le vehicule');

    // }

    //     return new Response("Le voila j'ai trouver le vehicule :" .$vehicules->getMarques());

    //     dd($vehicules);
    
    // }


}
