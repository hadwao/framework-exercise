<?php
namespace Core;

use Doctrine\ORM\EntityManager;

class FrontController
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;


    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function run()
    {
        echo $this->dispatcher->dispatch();

    }
}