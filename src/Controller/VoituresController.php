<?php

namespace App\Controller;

use App\Entity\Voitures;
use App\Entity\Acontacter;
use App\Form\VoituresType;
use App\Form\AcontacterType;
use App\Repository\VoituresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/voitures')]
class VoituresController extends AbstractController
{
    #[Route('/', name: 'app_voitures_index', methods: ['GET'])]
    public function index(VoituresRepository $voituresRepository): Response
    {
        return $this->render('voitures/index.html.twig', [
            'voitures' => $voituresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_voitures_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voitures();
        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voitures/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voitures_show',  methods: ['GET', 'POST'])]
    public function show(Voitures $voiture, Request $request, EntityManagerInterface $entityManager): Response
    {
        $acontacter = new Acontacter();
        $form = $this->createForm(AcontacterType::class, $acontacter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($acontacter);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voitures/show.html.twig', [
            'voiture' => $voiture,
            'acontacter' => $acontacter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voitures_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voitures $voiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoituresType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voitures/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voitures_delete', methods: ['POST'])]
    public function delete(Request $request, Voitures $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voitures_index', [], Response::HTTP_SEE_OTHER);
    }

    // CETTE ROUTE EST POUR GERER LES FORMULAIRES DE CONTACT DES PERSONNES INTERESSER PAR LES VEHICULES

    // #[Route('/new', name: 'app_acontacter_new', methods: ['GET', 'POST'])]
    // public function newContact(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $acontacter = new Acontacter();
    //     $form = $this->createForm(AcontacterType::class, $acontacter);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($acontacter);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_voitures_show', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('acontacter/show.html.twig', [
    //         'acontacter' => $acontacter,
    //         'form' => $form,
    //     ]);
    // }

}
