<?php

namespace App\Controller;

use Stripe\StripeClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends AbstractController
{
    private $manager;
    private $gateway;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager=$manager;

        $this->gateway= new StripeClient($_ENV['STRIPES_SECRET_KEY']);
    }


    #[Route('/checkout', name: 'app_checkout', methods:"POST")]
    public function checkout(Request $request): Response 
    {
        $amount=$request->request->get('amount');

        $quantity=$request->request->get('quantity');

        // creation du checkout

        $checkout=$this->gateway->checkout->sessions->create(
            [
                  'line_items'=>[[
                      'price_data'=>[
                        'currency'=>$_ENV['STRIPES_CURRENCY'],
                        'product_data'=>[
                            'name'=>'Nike',
                        ],

                        'unit_amount'=>intval($amount),

                    ],
                    'quantity'=>$quantity
                  ]],

                  'mode'=>'payment',
                  'success_url'=>'https://127.0.0.1:8000/success?id_sessions={CHECKOUT_SESSION_ID}',
                  'cancel_url'=>'https://127.0.0.1:8000/cancel?id_sessions={CHECKOUT_SESSION_ID}'
            ]);

            return $this->redirect($checkout->url);


          dd($request);
        

        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);
    }

    #[Route('/success', name: 'app_success')]
    public function success(Request $request): Response
    {
        $id_sessions=$request->query->get('id_sessions');

        
        //Récupère le customer via l'id de la  session
        $customer=$this->gateway->checkout->sessions->retrieve(
            $id_sessions,
            []
        );

        //Récupérer les informations du customer et de la transaction

        $name=$customer["customer_details"]["name"];

        $email=$customer["customer_details"]["email"];

        $payment_status=$customer["payment_status"];

        $amount=$customer['amount_total'];

       

        //Stocker au niveau de la base de données



        //Email au customer




        //Message de succès


        return $this->render('success/success.html.twig',[
            'name'=>$name
        ]);

    }


    #[Route('/cancel', name: 'app_cancel')]
    public function cancel(Request $request): Response
    {
        dd("cancel");
    }
}
