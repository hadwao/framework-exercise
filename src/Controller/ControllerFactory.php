<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 25.06.18
 * Time: 21:28
 */

namespace Controller;


use Core\AppConf;
use Core\Dispatcher\ControllerNotExistsException;
use Core\FrontController;
use Core\Request\HttpRequest;
use Core\Router;
use Core\Session\MessageBoxInterface;
use Core\Session\SessionInterface;
use Core\View\ViewInterface;
use DI\Container;
use Doctrine\ORM\EntityManager;
use Entity\User;

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
        /**
         * @var AbstractController $controller
         */
        $controller = $this->container->get($controllerClass);
        $controller
            ->setFlash($this->container->get(MessageBoxInterface::class))
            ->setUser($this->container->get(User::class))
            ->setConfig($this->container->get(AppConf::class))
            ->setEntityManager($this->container->get(EntityManager::class))
            ->setFrontController($this->container->get(FrontController::class))
            ->setRequest($this->container->get(HttpRequest::class))
            ->setRouter($this->container->get(Router::class))
            ->setSession($this->container->get(SessionInterface::class))
            ->setView($this->container->get(ViewInterface::class))
        ;

        return $controller;
    }
}