<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 25.06.18
 * Time: 21:28
 */

namespace Controller;


use Core\Dispatcher\ControllerNotExistsException;
use DI\Container;

class ControllerFactory
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $controllerClass
     * @return AbstractController
     * @throws ControllerNotExistsException
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function createController(string $controllerClass): AbstractController
    {
        if (!class_exists($controllerClass)) {
            throw new ControllerNotExistsException('Controller: ' . $controllerClass .' doesn\'t exist');
        }
        return $this->container->get($controllerClass);
    }
}