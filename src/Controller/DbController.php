<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Video;
use App\Entity\Address;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DbController extends AbstractController
{
    /**
     * @Route("/db", name="db")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        if(!$users)
        {
            throw $this->createNotFoundException('The users do not exist');
        }

        $gifts = ['flowers', 'car', 'piano', 'money'];

        shuffle($gifts);

        return $this->render('db/index.html.twig', [
            'controller_name' => 'DbController',
            'users' => $users,
            'gifts' => $gifts,
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

    /**
     * @Route("/db/video", name="db_video")
     */
    public function video(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName('Robert');

        for($i=1; $i<=3; $i++)
        {
            $video = new Video();
            $video->setTitle('Video title -'. $i);
            $user->addVideo($video);
            $entityManager->persist($video);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        dump('Created a video with the id of '. $video->getId());
        dump('Created a user with the id of '. $user->getId());

        $video = $this->getDoctrine()
        ->getRepository(Video::class)
        ->find(1);

        dump($video->getUser());
        dump($video->getUser()->getName());

        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find(1);

        foreach($user->getVideos() as $video)
        {
            dump($video->getTitle());
        }
        
        return $this->render('db/index.html.twig', [
            'controller_name' => 'DbController',
            'users' => [],
            'gifts' => [],
        ]);
    }  

    /**
     * @Route("/db/videod", name="db_videod")
     */
    public function videod(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find(1);

        $video = $this->getDoctrine()
        ->getRepository(Video::class)
        ->find(1);

        $user->removeVideo($video);
        $entityManager->flush();

        foreach($user->getVideos() as $video)
        {
            dump($video->getTitle());
        }

        // $entityManager->remove($user);
        // $entityManager->flush();
        // dump($user);

        return $this->render('db/index.html.twig', [
            'controller_name' => 'DbController',
            'users' => [],
            'gifts' => [],
        ]);
    }

    /**
     * @Route("/db/address", name="db_address")
     */
    public function address(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName('John');

        $address = new Address();
        $address->setStreet('street');
        $address->setNumber(23);
        $user->setAddress($address);

        $entityManager->persist($user);
        // $entityManager->persist($address); // required, if `cascade: persist` is not set
        $entityManager->flush();

        dump($user->getAddress()->getStreet());

        return $this->render('db/index.html.twig', [
            'controller_name' => 'DbController',
            'users' => [],
            'gifts' => [],
        ]);
    }  

    /**
     * @Route("/db/follow", name="db_follow")
     */
    public function follow(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        for ($i = 1; $i <= 4; $i++)
        {
            $user = new User();
            $user->setName('Robert -' . $i);
            $entityManager->persist($user);
        }
        $entityManager->flush();
        dump('last user id - '.$user->getId());

        $user1 = $entityManager->getRepository(User::class)->find(1);
        $user2 = $entityManager->getRepository(User::class)->find(2);
        $user3 = $entityManager->getRepository(User::class)->find(3);
        $user4 = $entityManager->getRepository(User::class)->find(4);

        $user1->addFollowed($user2);
        $user1->addFollowed($user3);
        $user1->addFollowed($user4);
        $entityManager->flush();

        dump($user1->getFollowed()->count());
        dump($user1->getFollowing()->count());
        dump($user4->getFollowing()->count());

        return $this->render('db/index.html.twig', [
            'controller_name' => 'DbController',
            'users' => [],
            'gifts' => [],
        ]);
    }  

    /**
     * @Route("/db/eager", name="db_eager")
     */
    public function eager(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName('Robert');

        for($i=1; $i<=3; $i++)
        {
            $video = new Video();
            $video->setTitle('Video title -'. $i);
            $user->addVideo($video);
            $entityManager->persist($video);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        $user = $entityManager->getRepository(User::class)->findWithVideos(1);
        dump($user);

        return $this->render('db/index.html.twig', [
            'controller_name' => 'DbController',
            'users' => [],
            'gifts' => [],
        ]);
    }  
}
