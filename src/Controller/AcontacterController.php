<?php

namespace App\Controller;

use App\Entity\Acontacter;
use App\Form\AcontacterType;
use App\Repository\AcontacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/acontacter')]
class AcontacterController extends AbstractController
{
    #[Route('/', name: 'app_acontacter_index', methods: ['GET'])]
    public function index(AcontacterRepository $acontacterRepository): Response
    {  
        return $this->render('acontacter/index.html.twig', [
            'acontacters' => $acontacterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_acontacter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $acontacter = new Acontacter();
        $form = $this->createForm(AcontacterType::class, $acontacter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($acontacter);
            $entityManager->flush();

            return $this->redirectToRoute('app_acontacter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('acontacter/show.html.twig', [
            'acontacter' => $acontacter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acontacter_show', methods: ['GET'])]
    public function show(Acontacter $acontacter): Response
    {
        return $this->render('acontacter/show.html.twig', [
            'acontacter' => $acontacter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_acontacter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Acontacter $acontacter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AcontacterType::class, $acontacter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_acontacter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('acontacter/edit.html.twig', [
            'acontacter' => $acontacter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acontacter_delete', methods: ['POST'])]
    public function delete(Request $request, Acontacter $acontacter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acontacter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($acontacter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_acontacter_index', [], Response::HTTP_SEE_OTHER);
    }
}
