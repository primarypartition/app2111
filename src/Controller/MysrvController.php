<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\MyService;
use App\Services\MyService2;
use App\Services\MyService3;

class MysrvController extends AbstractController
{
    /**
     * @Route("/mysrv", name="mysrv")
     */
    public function index(Request $request,  MyService $service)
    {
        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv2", name="mysrv2")
     */
    public function index2(Request $request,  MyService2 $service)
    {
        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }

    /**
     * @Route("/mysrv3", name="mysrv3")
     */
    public function index3(Request $request,  MyService3 $service)
    {
        $service->someAction();

        return $this->render('mysrv/index.html.twig', [
            'controller_name' => 'MysrvController',
        ]);
    }
}
