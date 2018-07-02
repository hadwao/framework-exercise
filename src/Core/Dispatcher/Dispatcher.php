<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:53
 */

namespace Core\Dispatcher;


use Controller\ControllerFactory;
use Core\Response\ResponseInterface;
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

    public function __construct(Router $router, ControllerFactory $controllerFactory, Container $container)
    {
        $this->router = $router;
        $this->controllerFactory = $controllerFactory;
        $this->container = $container;
    }

    public function dispatch(): ResponseInterface
    {
        $controllerClass = $this->router->getController();
        $action = $this->router->getAction();

        $controller = $this->controllerFactory->create($controllerClass);

        if (!method_exists($controller, $action)) {
            throw new ActionNotExistsException('Brak akcji:  '. $action .' w kontrolerze: '. $controllerClass);
        }

        $response = $this->container->call([$controller, $action]);

        if (! $response instanceof ResponseInterface) {
            throw new \Exception('Controller must return Response object');
        }

        return $response;
    }

}