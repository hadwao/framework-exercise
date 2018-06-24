<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:53
 */

namespace Core;


use Controller\ArticleController;
use DI\Annotation\Inject;
use DI\Container;

class Dispatcher
{
    /**
     * @var Dispatcher
     */
    private $router;

    /**
     * @var Container
     */
    private $container;

    public function __construct(Router $router, Container $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function dispatch()
    {
        $controller = $this->router->getController();
        $action = $this->router->getAction();

        $controller = $this->container->get($controller);

        return $controller->$action();



    }

}