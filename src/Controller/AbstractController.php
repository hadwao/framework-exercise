<?php

namespace Controller;


use Core\Config\ConfigInterface;
use Core\FrontController;
use Core\Request\HttpRequest;
use Core\Response\HttpResponse;
use Core\Response\ResponseInterface;
use Core\Router;
use Core\Session\MessageBoxInterface;
use Core\Session\SessionInterface;
use Core\User\UserInterface;
use Core\View\ViewInterface;
use Doctrine\ORM\EntityManager;


abstract class AbstractController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var FrontController
     */
    protected $frontController;

    /**
     * @var ViewInterface
     */
    protected $view;

    /**
     * @var MessageBoxInterface
     */
    protected $flash;

    public function __construct(
        EntityManager $entityManager,
        HttpRequest $request,
        SessionInterface $session,
        Router $router,
        ConfigInterface $config,
        UserInterface $user,
        FrontController $frontController,
        ViewInterface $view,
        MessageBoxInterface $flash
    ) {
        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->session = $session;
        $this->router = $router;
        $this->config = $config;
        $this->user = $user;
        $this->frontController = $frontController;
        $this->view = $view;
        $this->flash = $flash;
    }


    /**
     * @return HttpRequest
     */
    public function getRequest(): HttpRequest
    {
        return $this->request;
    }

    public function renderView($template, $vars = []): ResponseInterface
    {
        $globalVars = [
            'user' => $this->user,
            'session' => $this->session,
            'flash' => $this->flash,
        ];
        $response = new HttpResponse();
        $viewVars = array_merge($vars, $globalVars);
        $output = $this->view->renderView($template, $viewVars);
        return $response->setBody($output);
    }

    /**
     * @return ResponseInterface
     */
    public function redirect(string $uri)
    {
        return $this->frontController->redirect($uri);
    }

    public function isUserSigned(): bool
    {
        return $this->user && $this->user->hasCredentials('user');
    }

    protected function requestParam($name, $default = null)
    {
        return $this->router->parameter($name, $default);
    }


}