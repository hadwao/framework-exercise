<?php
namespace Core;

use DI\Annotation\Inject;

class FrontController
{
    /**
     * @var Dispatcher
     * @Inject
     */
    private $dispatcher;

    public function run()
    {
        var_dump($this->dispatcher->dispatch());
        echo $this->dispatcher->dispatch();
    }
}