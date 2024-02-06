<?php

namespace App\Controller;

use App\Entity\Voitures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChevroletController extends AbstractController
{
    #[Route('/chevrolet', name: 'app_chevrolet')]
    public function index(EntityManagerInterface $entityManager) : Response
    {
         // Obtenez le gestionnaire d'entités pour interagir avec la base de données
        //  $repository = $VoituresRepository->findAll();
         $repository = $entityManager->getRepository(Voitures::class);


        $Chevrolet = $repository->createQueryBuilder('c')
        ->where('c.nom LIKE :nom')
        ->setParameter('nom', '%Chevrolet%')
        ->getQuery()
        ->getResult();

        // dd($Chevrolet);
        
        return $this->render('Chevrolet/index.html.twig', [
            'Chevrolet' => $Chevrolet,
        ]);
    }
}
