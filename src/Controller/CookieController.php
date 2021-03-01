<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Services\GiftsService;

use Symfony\Component\HttpFoundation\Cookie;

class CookieController extends AbstractController
{
    /**
     * @Route("/cookie", name="cookie")
     */
    public function index(GiftsService $gifts): Response
    {
         // $users = [];
         $users = $this->getDoctrine()->getRepository(User::class)->findAll();

         $cookie = new Cookie(
             'my_cookie',	// Cookie name
             'cookie value',	// Cookie value
             time() + ( 2 * 365 * 24 * 60 * 60)	// Expires after 2 years
         );
 
         $res = new Response();
         $res->headers->setCookie( $cookie );
         $res->send();
 
        //  $res = new Response();
        //  $res->headers->clearCookie('my_cookie');
        //  $res->send();
 
         return $this->render('cookie/index.html.twig', [
             'controller_name' => 'CookieController',
             'users' => $users,
             'random_gift' => $gifts->gifts,
         ]);
    }
}
