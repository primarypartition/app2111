<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\MyService;
use App\Services\MyService2;
use App\Services\MyService3;
use App\Services\MyService4;
use App\Services\MyService5;
use App\Services\MyService6;
use App\Services\MyService7;

use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Services\ServiceInterface8;
class MysrvController extends AbstractController
{
    /**
     * @Route("/mysrv", name="mysrv")
     */
    public function index(Request $request, MyService $service)
    {
        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv2", name="mysrv2")
     */
    public function index2(Request $request, MyService2 $service)
    {
        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv3", name="mysrv3")
     */
    public function index3(Request $request, MyService3 $service)
    {
        $service->someAction();

        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv4", name="mysrv4")
     */
    public function index4(Request $request, MyService4 $service)
    {
        $service->someAction();

        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv5", name="mysrv5")
     */
    public function index5(Request $request, MyService5 $service)
    {
        dump($service->secService->someMethod());
        
        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv6", name="mysrv6")
     */
    public function index6(Request $request, MyService6 $service, ContainerInterface $container)
    {
        dump($container->get('app.myservice6'));
        
        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv7", name="mysrv7")
     */
    public function index7(Request $request, MyService7 $service)
    {    
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->find(1);
        $user->setName('Rob');
        $entityManager->persist($user);

        $entityManager->flush();

        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv8", name="mysrv8")
     */
    public function index8(Request $request, ServiceInterface8 $service)
    {
        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }
}
