<?php
namespace App\Services;

// use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

use Symfony\Component\HttpFoundation\Response;

class KernelResponseListener {
    
    public function onKernelResponse(ResponseEvent $event)
    {
        // $response = new Response('event response overwrite');

        // $event->setResponse($response);
    }
}
