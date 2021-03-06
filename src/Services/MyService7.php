<?php
namespace App\Services;

use Doctrine\ORM\Event\PostFlushEventArgs;

class MyService7 {

    public function __construct()
    {
        dump('hello!');
    }

    public function postFlush(PostFlushEventArgs $args)
    {
        dump('hello postflush!');
        dump($args);
    }

    public function clear()
    {
        dump('clear ... ');
    }

}
