<?php

namespace App\Controller;


use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    // #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        // 
        $panier = $session->get('panier', []);

        // declaration des variables

        $session->set('panier', []);
        $data = [];
        $total = 0;
        foreach ($panier as $id => $quantite){
            $produit = $produitsRepository->find($id);

            $data[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
        } 

        return $this->render('panier/index.html.twig', [
            'items' => $data,
        ]);

    }   

     
    #[Route('/add/{id}', name: 'add')]
    public function add(ProduitsRepository $produitsRepository, SessionInterface $session)
    {

            // Je recup l'id du produit

            $id = $produitsRepository->getId();

            // Je recup le panier existant si y'en un
            $panier = $session->get('panier', []);

            // on ajoute le produit dans le panier s'il n'y est pas encore
            // sinon j'inscremente

            if(empty($panier[$id])){
                $panier[$id] = 1;

            }else{
                $panier[$id]++;
            }
            
            $session->set('panier', $panier);
            
            // Ensuite redirection page panier
            return $this->redirectToRoute('app_panier');

    }
}
