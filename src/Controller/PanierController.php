<?php
namespace App\Controller;

use App\DTO\CartDTO;
use App\DTO\CartItemDTO;
use App\Form\CartType;
use App\Form\CartCollectionType;
use App\Repository\OrderRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    // #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProductsRepository $ProductsRepository, Request $request)
    {
        // création d'un formulaire contenant une collection de formulaires gérants
        // chaque produit et sa quantité
        // ces formulaires seront mappés à des DTOs qu'il faudra aussi créer
        $cartDTO = new CartDTO();
        $cart = $request->getSession()->get('panier', []);
        foreach ($cart as $product) {
            $sale = new CartItemDTO();
            $sale->setProduct($product);
            $cartDTO->addProduct($sale);
        }
        $form = $this->createForm(CartCollectionType::class, $cartDTO);
        $form->handleRequest($request);
        $cartDTO->initializeCart();

        if ($form->isSubmitted() && $form->isValid())
        {   


            // envoyer vers la page de paiement
            // dd($cartDTO);
            // produits soumis du formulaire :

            // dd($products);
            return $this->redirectToRoute("app_commandes_new");

        }
    
        return $this->render('panier/index.html.twig', [
            'cart' => $cart,
            'cartForm' => $form->createView(),
        ]);
        
    
    }

    #[Route('/{id}/add-cart', name: 'app_product_add_cart', methods: ['GET'])]
    public function addCart($id, Request $request, ProductsRepository $repository): Response
    {
    $product = $repository->find((int)$id);
    $cart = [];
    if ($request->getSession()->get('panier')) {
        $cart = $request->getSession()->get('panier');
    }
    $cart[] = $product;
    $request->getSession()->set('panier', $cart);

    return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }

    // function remove product

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(ProductsRepository $ProductsRepository, Request $request, $id): Response
    {
        $product = $ProductsRepository->find((int)$id);
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->query->get('csrf_token'))) {
            $panier = $request->getSession()->get('panier');
            $result = array_filter($panier, function ($item) use ($product) {
                return $item->getId() !== $product->getId();
            });
            $request->getSession()->set('panier', $result);
        }

        return $this->redirectToRoute("app_panier");
    }

    // Pour les fiches produits des accessoires

}