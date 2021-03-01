<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Services\GiftsService;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     */
    public function index(GiftsService $gifts, SessionInterface $session, Request $request)
    {
        // $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        // exit($request->cookies->get('PHPSESSID'));

        $session->set('name', 'session value');

        if($session->has('name'))
        {
            exit($session->get('name'));
        }

        $session->remove('name');
        $session->clear();

        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }  
}
