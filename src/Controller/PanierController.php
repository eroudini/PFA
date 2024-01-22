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
        $panier = $session->get("panier", []);
        // On "fabrique" les données
        // $dataPanier = [];
        // $total = 0;

        // foreach($panier as $Id => $quantite){
        //     $produit = $produitsRepository->find($Id);
        //     $dataPanier[] = [
        //         "produit" => $produit,
        //         "quantite" => $quantite
        //     ];
        //     $total += $produit->getPrix() * $quantite;
        // }

        return $this->render('panier/index.html.twig', 
            [
                "produits" => $panier,
            ]
        );

        // return $this->render('panier/index.html.twig', [
        //     'items' => $dataPanier,
        // ]);

    }   

 
    #[Route('/add/{id}', name: 'add')]
    public function add(ProduitsRepository $produitsRepository, Request $request, $id)
    {
        $product = $produitsRepository->find((int)$id);
        $panier = [];
        if ($request->getSession()->has('panier')){
            $panier = $request->getSession()->get('panier');
        }
        $panier[] = $product;
        $panier = $request->getSession()->set('panier', $panier);
        
        // Ensuite redirection page panier
        return $this->redirectToRoute('home');

    }

     // function remove product

    #[Route('/remove/{id}', name: 'remove')]    
    public function remove(ProduitsRepository $produitsRepository, Request $request, $id)
    {
          // je recup le produit a partir de l'id
          $product = $produitsRepository->find((int)$id);
          // je recup le panier actuel
          $panier = $request->getSession()->get('panier');
          $id = $product->getId();
        // je verifie si le produit existe dans le panier et si oui je le supprime avec unset
          if(!empty($panier[$id])){
            unset($panier[$id]);
        }

          // On sauvegarde dans la session
          $panier = $request->getSession()->set('panier', $panier);
  
          return $this->redirectToRoute("app_panier");
      }
  

}
