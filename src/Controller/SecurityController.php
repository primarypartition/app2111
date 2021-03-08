<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use App\Form\RegisterUserType;

use App\Entity\SecurityUser;
use App\Entity\Video;

class SecurityController extends AbstractController
{    
    /**
     * @Route("/security", name="security")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $users = $entityManager->getRepository(SecurityUser::class)->findAll();
        dump($users);

        $user = new SecurityUser();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $form->get('password')->getData())
            );

            $user->setEmail($form->get('email')->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('security');
        }

        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/security2", name="security2")
     */
    public function index2(Request $request)
    {
        return $this->render('security/index2.html.twig', [
            'controller_name' => 'SecurityController',       
        ]);
    } 

    // @Security("has_role('ROLE_ADMIN')")
    /**
     * @Route("/security3/{id}/delete-video", name="security3")
     * @Security("user.getId() == video.getSecurityUser().getId()")
     */
    public function index3(Request $request, Video $video)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(SecurityUser::class)->findAll();
        dump($users);
        dump($video);

        // security.yaml
        // access_control:
        // - { path: ^/admin, roles: ROLE_ADMIN }

        return $this->render('security/index2.html.twig', [
            'controller_name' => 'SecurityController',       
        ]);
    }  

    /**
     * @Route("/security4", name="security4")
     */
    public function index4(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(SecurityUser::class)->findAll();
        dump($users);
     
        $user1 = new SecurityUser;
        $user1->setEmail('user@role.com');
        $pass1 = $passwordEncoder->encodePAssword($user1, 'password');
        $user1->setPassword($pass1);
        
        $user2 = new SecurityUser;
        $user2->setEmail('admin@role.com');
        $pass2 = $passwordEncoder->encodePAssword($user2, 'password');
        $user2->setPassword($pass2);
        $user2->setRoles(['ROLE_ADMIN']);

        $video = new Video;
        $video->setTitle('video title 1');
        $video->setFile('video path');
        $video->setCreatedAt(new \DateTime());
       
        $entityManager->persist($user1);
        $entityManager->persist($user2);
        $entityManager->persist($video);

        $user2->addVideo($video);
        $entityManager->persist($user2);

        $entityManager->flush();

        dump($user1);
        dump($user2);
        dump($video);
        
        return $this->render('security/index2.html.twig', [
            'controller_name' => 'SecurityController',       
        ]);
    } 

    /**
     * @Route("/security5", name="security5")
     */
    public function index5(Request $request)
    {        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('security/index2.html.twig', [
            'controller_name' => 'SecurityController',       
        ]);
    } 

    /**
     * @Route("/security6", name="security6")
     */
    public function index6(Request $request)
    {    
        return $this->render('security/index3.html.twig', [
            'controller_name' => 'SecurityController',       
        ]);
    } 

    /**
     * @Route("/security7", name="security7")
     */
    public function index7(Request $request)
    {    
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository(Video::class)->find(1);
        
        $this->denyAccessUnlessGranted('VIDEO_DELETE', $video);

        return $this->render('security/index3.html.twig', [
            'controller_name' => 'SecurityController',       
        ]);
    } 

    /**
     * @Route("/security/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',       
            'last_username' => $lastUsername,
            'error'         => $error,
        ]); 
    }
}
