<?php
namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
    #[Route("/hello", name: "hello")]
    public function hello(){
        return $this->render("hello.html.twig");
    }
   
    #[Route("/", name: "home")]
    public function home(ProductsRepository $ProductsRepository, Request $request): Response
    {
        $produits = $ProductsRepository->findAll();
        // dd($request->getSession()->get('panier'));
        return $this->render("home.html.twig", [
            'produits' => $produits
        ]);
    }
    

}
