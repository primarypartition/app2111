<?php
namespace App\Services;

use App\Services\MySecondService;

class MyService4 {

    public $logger;
    public $my;

    public function someAction()
    {
        dump($this->logger);
        dump($this->my);
    }

}
