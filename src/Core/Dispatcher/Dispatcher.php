<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:53
 */

namespace Core\Dispatcher;


use Controller\ControllerFactory;
use Core\Router;
use DI\Container;

class Dispatcher
{
    /**
     * @var Dispatcher
     */
    protected $router;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var ControllerFactory
     */
    protected $controllerFactory;

    public function __construct(Router $router, ControllerFactory $controllerFactory)
    {
        $this->router = $router;
        $this->controllerFactory = $controllerFactory;
    }

    public function dispatch()
    {
        $controllerClass = $this->router->getController();
        $action = $this->router->getAction();

        $controller = $this->controllerFactory->create($controllerClass);

        if (!method_exists($controller, $action)) {
            throw new ActionNotExistsException('Brak akcji:  '. $action .' w kontrolerze: '. $controllerClass);
        }

        return $controller->$action();
    }

}