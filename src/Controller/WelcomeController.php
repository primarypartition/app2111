<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index(): Response
    {
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }

    /**
     * @Route("/welcome2/{name}", name="welcome2_arg")
     */
    public function index2($name): Response
    {
        return $this->redirectToRoute('welcome3');
    }

    /**
     * @Route("/welcome3", name="welcome3")
     */
    public function index3(): Response
    {
        return new Response('I am from default2 route!');
    }

    /**
     * @Route("/welcome4/api", name="welcome4_api")
     */
    public function api(): Response
    {
        return $this->json(['controller_name' => 'WelcomeController']);
    }

    /**
     * @Route("/welcome5/{name}", name="welcome5_arg")
     */
    public function index4($name): Response
    {
        return new Response('Welcome, ' . $name);
    }

    /**
     * @Route("/welcome6", name="welcome6")
     */
    public function index6(Request $request)
    {     
        dump($request, $this);

        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }  
}
