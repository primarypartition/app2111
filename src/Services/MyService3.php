<?php
namespace App\Services;

use App\Services\MySecondService2;

class MyService3 {

    use OptionalServiceTrait;

    public function __construct()
    {
        // dump($second_service);
    }

    public function someAction()
    {
        dump($this->service->doSomething2());
    }

    /**
     * @required
     */
    // public function setSecondService(MySecondService2 $second_service)
    // {
    //     dump($second_service);
    // }
}
