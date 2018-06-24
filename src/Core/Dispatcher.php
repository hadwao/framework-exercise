<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:53
 */

namespace Core;


use Controller\ArticleController;

class Dispatcher
{
    /**
     * @var Dispatcher
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function dispatch()
    {
        $controller = $this->router->getController();
        $action = $this->router->getAction();


    }

}