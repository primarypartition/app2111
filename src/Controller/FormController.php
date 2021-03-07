<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\VideoFormType;

use App\Entity\Video;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $videos = $entityManager->getRepository(Video::class)->findAll();
        dump($videos);

        $video = new Video();
        // $video->setTitle('Write a blog post');
        // $video->setCreatedAt(new \DateTime('tomorrow'));

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            dump($form->getData());

            $entityManager->persist($video);
            $entityManager->flush();

            // return $this->redirectToRoute('form');
        }

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView(),
        ]);
    }
}
