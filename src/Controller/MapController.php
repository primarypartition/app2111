<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Author;
use App\Entity\File;
use App\Entity\Pdf;
use App\Entity\Video;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $items = $entityManager->getRepository(Pdf::class)->findAll();
        dump($items);

        $items = $entityManager->getRepository(Video::class)->findAll();
        dump($items);

        $items = $entityManager->getRepository(File::class)->findAll();
        dump($items);

        $item = $entityManager->getRepository(File::class)->find(1);
        dump($item);

        $author = $entityManager->getRepository(Author::class)->findByIdWithPdf(1);

        dump($author);

        foreach($author->getFiles() as $file)
        {
            // if($file instanceof Pdf)
            dump($file->getFileName());
        }

        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',
        ]);
    }
}
