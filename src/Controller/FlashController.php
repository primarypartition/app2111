<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;

use App\Services\GiftsService;

class FlashController extends AbstractController
{
    /**
     * @Route("/flash", name="flash")
     */
    public function index(GiftsService $gifts)
    {
        // $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );

        $this->addFlash(
            'warning',
            'Your changes were saved!'
        );
        
        return $this->render('flash/index.html.twig', [
            'controller_name' => 'FlashController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }
}
