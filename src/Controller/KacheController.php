<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class KacheController extends AbstractController
{
    /**
     * @Route("/kache", name="kache")
     */
    public function index(): Response
    {
        $cache = new FilesystemAdapter();
        $posts = $cache->getItem('database.get_posts');
        
        if (!$posts->isHit())
        {
            $posts_from_db = ['post 1', 'post 2', 'post 3'];
            dump('connected with database ... ');

            $posts->set(serialize($posts_from_db));
            $posts->expiresAfter(5);
            $cache->save($posts);
        }
        // $cache->deleteItem('database.get_posts');
        $cache->clear();
        dump(unserialize($posts->get()));

        return $this->render('kache/index.html.twig', [
            'controller_name' => 'KacheController',
        ]);
    }
}
