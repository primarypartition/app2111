<?php
namespace App\Services;

class MySecondService8 implements ServiceInterface8  {

    public function __construct()
    {
        dump('hello from second service!');
    }
}
