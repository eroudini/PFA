<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        $panier = $session->get("panier", []);
        // On "fabrique" les données
        // $dataPanier = [];
        // $total = 0;

        // foreach($panier as $Id => $quantite){
        //     $produit = $produitsRepository->find($Id);

        //     if($produit){
        //         $dataPanier[] = [
        //             "produit" => $produit,
        //             "quantite" => $quantite
        //         ];

        //     }
            
        //     $total += $produit->getPrix() * $quantite;
        // }



        return $this->render('panier/index.html.twig', 
            [
                "produits" => $panier,
            
            ]
        );


    } 

    #[Route('/add/{id}', name: 'add')]
    public function add(ProduitsRepository $produitsRepository, Request $request, $id)
    {
        $product = $produitsRepository->find((int)$id);
        $panier = [];
        if ($request->getSession()->has('panier')){
            $panier = $request->getSession()->get('panier');
            // $panier->setQuantity(1);
        }
        $panier[] = $product;
        $panier = $request->getSession()->set('panier', $panier);
        
        // Ensuite redirection page panier

        return $this->redirectToRoute('home');

    }

     // function remove product

    #[Route('/remove/{id}', name: 'remove')]    
    public function remove(ProduitsRepository $produitsRepository, Request $request, $id): Response
    {
        $product = $produitsRepository->find((int)$id);
        if($this->isCsrfTokenValid('delete'.$product->getId(), $request->query->get('csrf_token'))) {
            $panier = $request->getSession()->get('panier');
            $result = array_filter($panier, function($item) use ($product){
                return $item->getId() !== $product->getId();
            });
            $request->getSession()->set('panier', $result);
        }

          return $this->redirectToRoute("app_panier");
      }
  
}
