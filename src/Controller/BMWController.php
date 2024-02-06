<?php

namespace App\Controller;

use App\Entity\Voitures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BMWController extends AbstractController
{
    #[Route('/bmw', name: 'app_bmw')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Obtenez le gestionnaire d'entités pour interagir avec la base de données
       //  $repository = $VoituresRepository->findAll();
        $repository = $entityManager->getRepository(Voitures::class);


       $BMW = $repository->createQueryBuilder('b')
       ->where('b.nom LIKE :nom')
       ->setParameter('nom', '%BMW%')
       ->getQuery()
       ->getResult();

       // dd($mercedes);
       
       return $this->render('BMW/index.html.twig', [
           'BMW' => $BMW,
       ]);
   }
}
