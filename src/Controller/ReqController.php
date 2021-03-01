<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;

use App\Services\GiftsService;

class ReqController extends AbstractController
{
    /**
     * @Route("/req", name="req")
     */
    public function index(GiftsService $gifts, Request $request)
    {
        // $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        // exit($request->query->get('page', 'default'));
        exit($request->server->get('HTTP_HOST'));

        $request->isXmlHttpRequest(); // is it an Ajax request?
        $request->request->get('page');
        $request->files->get('foo');
        
        return $this->render('req/index.html.twig', [
            'controller_name' => 'ReqController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }  
}
