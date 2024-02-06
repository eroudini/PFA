<?php

namespace App\Controller;

use App\Entity\Voitures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AudiController extends AbstractController
{
    #[Route('/audi', name: 'app_audi')]
    public function index(EntityManagerInterface $entityManager) : Response
    {
         // Obtenez le gestionnaire d'entités pour interagir avec la base de données
        //  $repository = $VoituresRepository->findAll();
         $repository = $entityManager->getRepository(Voitures::class);


        $Audi = $repository->createQueryBuilder('a')
        ->where('a.nom LIKE :nom')
        ->setParameter('nom', '%Audi%')
        ->getQuery()
        ->getResult();

        return $this->render('audi/index.html.twig', [
            'Audi' => $Audi,
        ]);
    }
}
