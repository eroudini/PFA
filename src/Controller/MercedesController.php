<?php

namespace App\Controller;

use App\Entity\Voitures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MercedesController extends AbstractController
{
    #[Route('/mercedes', name: 'app_mercedes')]
    public function index(EntityManagerInterface $entityManager) : Response
    {
         // Obtenez le gestionnaire d'entités pour interagir avec la base de données
        //  $repository = $VoituresRepository->findAll();
         $repository = $entityManager->getRepository(Voitures::class);


        $mercedes = $repository->createQueryBuilder('v')
        ->where('v.nom LIKE :nom')
        ->setParameter('nom', '%Mercedes%')
        ->getQuery()
        ->getResult();

        // dd($mercedes);
        
        return $this->render('mercedes/index.html.twig', [
            'mercedes' => $mercedes,
        ]);
    }
}
