<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/view", name="view")
     */
    public function index(): Response
    {
        $users = ['Adam', 'Robert', 'John', 'Susan'];
        
        return $this->render('view/index.html.twig', [
            'controller_name' => 'ViewController',
            'users' => $users,
        ]);
    }

    /**
     * No route
     */
    public function mostPopularPosts($number = 3)
    {
         // database call:
         $posts = ['post 1', 'post 2', 'posts 3', 'posts 4'];

         return $this->render('view/most_popular_posts.html.twig', [
            'posts' => $posts,
         ]);
    }
}
