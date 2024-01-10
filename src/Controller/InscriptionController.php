<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;


class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(InscriptionType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = new User();
            $user->setMail($data["email"]);
            $user->setPassword($data["password"]);
            $em->persist($user);
            $em->flush();
            // dd($user);
        };
        return $this->render('inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    // READ UPDATE DELETE 

    #[Route("/user/{id}", name: "user_detail", requirements: ['id' => '\d+'], methods: ["GET"])]
    public function read($id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find((int)$id);
        return $this->render('user/read.html.twig', [
            "user" => $user,
        ]);

        dd($user);
    }


    #[Route("/user/{id}/update", name: "user_update", methods: ["GET"], requirements: ["id" => "\d+"])]
    public function update()
    {
        return $this->render('user/update.html.twig', [
            "message" => "Ici la page de crétion d'un utilisateur"
        ]);
    }

    #[Route("/user/{id}/delete", name: "user_delete", methods: ["GET"], requirements: ["id" => "\d+"])]
    public function delete()
    {
        return $this->render('user/delete.html.twig', [
            "message" => "Ici la page de crétion d'un utilisateur"
        ]);
    }

    #[Route("/user/{id}/edit", name: "user_edit",  methods: ["GET", "POST"], requirements: ["id" => "\d+"])]
    public function edit($id, Request $request, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $user = $userRepository->find((int)$id);
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $em->flush();
        }

        return $this->render("user/edit.html.twig", [
            "form" => $form->createView()
        ]);
        dd($form);
    }
}
