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
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function create(string $controllerClass): AbstractController
    {
        if (!class_exists($controllerClass)) {
            throw new ControllerNotExistsException('Controller: ' . $controllerClass .' doesn\'t exist');
        }

        /**
         * @var AbstractController $controller
         */
        $controller = $this->container->get($controllerClass);

        if (!$controller instanceof AbstractController) {
            throw new \Exception("I expected " . AbstractController::class);
        }

       # if ($user = $this->container->get(UserInterface::class)) {
            # TODO: refactor code, so controller gathers user actively instead of getting user passively
            //$controller->setUser($user);
       # }
        return $controller;
    }
}