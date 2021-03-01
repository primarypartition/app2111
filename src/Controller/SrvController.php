<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\GiftsService;

use App\Entity\User;

class SrvController extends AbstractController
{
    /**
     * 
     */
    public function __construct(GiftsService $gifts)
    {
        $gifts->gifts = ['a','b','c','d'];
    }

    /**
     * @Route("/srv", name="srv")
     */
    public function index(GiftsService $gifts): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('srv/index.html.twig', [
            'controller_name' => 'SrvController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }
}
