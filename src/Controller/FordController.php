<?php

namespace App\Controller;

use App\Entity\Voitures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FordController extends AbstractController
{
    #[Route('/ford', name: 'app_ford')]
    public function index(EntityManagerInterface $entityManager) : Response
    {
         // Obtenez le gestionnaire d'entités pour interagir avec la base de données
        //  $repository = $VoituresRepository->findAll();
         $repository = $entityManager->getRepository(Voitures::class);


        $Ford = $repository->createQueryBuilder('f')
        ->where('f.nom LIKE :nom')
        ->setParameter('nom', '%Ford%')
        ->getQuery()
        ->getResult();

        // dd($Ford);
        
        return $this->render('ford/index.html.twig', [
            'Ford' => $Ford,
        ]);
    }
}
