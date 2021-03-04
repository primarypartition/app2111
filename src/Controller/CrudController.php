<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;

class CrudController extends AbstractController
{
    /**
     * @Route("/crud/list", name="crud_list")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        // $user = $repository->find(1);
        // $user = $repository->findOneBy(['name' => 'Robert']);
        // $user = $repository->findOneBy(['name' => 'Robert', 'id' => 5]);
        // $users = $repository->findBy(['name' => 'Robert'],['id' => 'DESC']);
        $users = $repository->findAll();

        dump($users);

        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }  

    /**
     * @Route("/crud/create", name="crud_create")
     */
    public function create(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $user->setName('Robert');

        $entityManager->persist($user);
        $entityManager->flush();

        dump('A new user was saved with the id of '. $user->getId());

        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }   
    
    /**
     * @Route("/crud/update", name="crud_update")
     */
    public function update(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $id = 1;
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user)
        {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $user->setName('New user name!');
        $entityManager->flush();

        dump($user);
        
        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }  

    /**
     * @Route("/crud/delete", name="crud_delete")
     */
    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $id = 2;
        $user = $entityManager->getRepository(User::class)->find($id);

        // $entityManager->remove($user);
        // $entityManager->flush();

        dump($user);
        
        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }  

    /**
     * @Route("/crud/query", name="crud_query")
     */
    public function query(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $conn = $entityManager->getConnection();

        $sql = '
        SELECT * FROM user u
        WHERE u.id > :id
        ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => 1]);

        dump($stmt->fetchAll());
        
        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }  

    /**
     * @Route("/crud/par/{id}", name="crud_par")
     */
    public function par(Request $request, User $user)
    {
        // $entityManager = $this->getDoctrine()->getManager();
        dump($user);
        
        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }  

    /**
     * @Route("/crud/life1", name="crud_life1")
     */
    public function life1(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $user->setName('Robert');

        $entityManager->persist($user);
        $entityManager->flush();
        
        return $this->render('crud/index.html.twig', [
            'controller_name' => 'CrudController',
        ]);
    }  
}
