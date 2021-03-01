<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;

class DbController extends AbstractController
{
    /**
     * @Route("/db", name="db")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('db/index.html.twig', [
            'controller_name' => 'DbController',
            'users' => $users,
        ]);
    }

    /**
     * @Route("/db/create", name="db_create")
     */
    public function create(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User;

        $user->setName("John1");

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('db/new.html.twig', [
            'controller_name' => 'DbController',
            'user' => $user
        ]);
    }
}
