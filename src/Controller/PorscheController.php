<?php

namespace App\Controller;

use App\Entity\Voitures;
use App\Repository\VoituresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PorscheController extends AbstractController
{
    #[Route('/porsche', name: 'app_porsche')]
    public function index(EntityManagerInterface $entityManager) : Response
    {
         // Obtenez le gestionnaire d'entités pour interagir avec la base de données
        //  $repository = $VoituresRepository->findAll();
         $repository = $entityManager->getRepository(Voitures::class);


        $VPorsche = $repository->createQueryBuilder('p')
        ->where('p.nom LIKE :nom')
        ->setParameter('nom', '%Porsche%')
        ->getQuery()
        ->getResult();

        return $this->render('porsche/index.html.twig', [
            'VPorsche' => $VPorsche,
        ]);
    }
}
