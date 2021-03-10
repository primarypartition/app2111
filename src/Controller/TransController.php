<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\Translation\TranslatorInterface;

class TransController extends AbstractController
{
    /**
     * @Route("/trans", name="trans")
     */
    public function index(Request $request, TranslatorInterface $translator): Response
    {
        $translated = $translator->trans('some.key');
        dump($translated);
        dump($request->getLocale());

        return $this->render('trans/index.html.twig', [
            'controller_name' => 'TransController',
        ]);
    }

    /**
     * @Route({
     *      "en": "/trans1",
     *      "pl": "/trans1topolish",
     * }, name="trans1")
     */
    public function index1(Request $request, TranslatorInterface $translator): Response
    {
        return $this->render('trans/index.html.twig', [
            'controller_name' => 'TransController',
        ]);
    }

    /**
     * @Route({
     *      "en": "/trans2",
     *      "pl": "/trans2topolish",
     * }, name="trans2")
     */
    public function index2(Request $request, TranslatorInterface $translator): Response
    {
        return $this->render('trans/index.html.twig', [
            'controller_name' => 'TransController',
        ]);
    }
}
