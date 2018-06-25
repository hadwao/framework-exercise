<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:53
 */

namespace Core\Dispatcher;


use Core\Router;
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

    /**
     * @return mixed
     * @throws ControllerNotExistsException
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @throws ActionNotExistsException
     */
    public function dispatch()
    {
        $controllerClass = $this->router->getController();
        $action = $this->router->getAction();

        if (!class_exists($controllerClass))
        {
            throw new ControllerNotExistsException('Kontroler: '. $controllerClass .' nie istnieje');
        }

        $controller = $this->container->get($controllerClass);

        if (!method_exists($controller, $action)) {
            throw new ActionNotExistsException('Brak akcji:  '. $action .' w kontrolerze: '. $controllerClass);
        }

        return $controller->$action();
    }

}