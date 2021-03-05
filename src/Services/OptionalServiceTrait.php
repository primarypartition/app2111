<?php
namespace App\Services;

use App\Services\MySecondService2;

trait OptionalServiceTrait {

    private $service;

    /**
     * @required
     */
    public function setSecondService(MySecondService2 $second_service)
    {
        $this->service = $second_service;
    }
}
