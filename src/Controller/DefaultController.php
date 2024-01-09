<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
    #[Route("/hello", name: "hello")]
    public function hello(){
        return $this->render("hello.html.twig");
    }
    #[Route("/connexion", name: "connexion")]
    public function connexion(){
        return $this->render("connexion.html.twig");
    }
    #[Route("/home", name: "home")]
    public function home(){
        return $this->render("home.html.twig");
    }
    #[Route("/inscription", name:"inscription")]
    public function inscription(){
        return $this->render("inscription.html.twig");

      
    }

}