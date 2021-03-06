<?php
namespace App\Services;

use App\Services\MySecondService5;

class MyService5 {

    public function __construct($service)
    {
        dump($service);
        $this->secService = $service;
    }
}
