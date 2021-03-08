<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\VideoFormType;
use App\Form\VideoFormType2;

use App\Entity\Video;
use App\Entity\Video3;

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

    /**
     * @Route("/form1", name="form1")
     */
    public function index1(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $video = $entityManager->getRepository(Video::class)->find(1);

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/form2", name="form2")
     */
    public function index2(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $videos = $entityManager->getRepository(Video3::class)->findAll();
        dump($videos);

        $video = new Video3();
    
        $form = $this->createForm(VideoFormType2::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $file = $form->get('file')->getData();
            $fileName = sha1(random_bytes(14)).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('videos_directory'),
                $fileName
            );

            $video->setFile($fileName);

            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('form2');
        }

        return $this->render('form/index2.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView(),
        ]);
    }
}
