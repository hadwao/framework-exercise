<?php

namespace Controller;


use Core\Config\ConfigInterface;
use Core\FrontController;
use Core\RepositoryManager;
use Core\Request\HttpRequest;
use Core\Response\HttpResponse;
use Core\Response\ResponseInterface;
use Core\Router;
use Core\Session\MessageBoxInterface;
use Core\Session\SessionInterface;
use Core\User\LoggedUserServiceInterface;
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
     * @var LoggedUserServiceInterface
     */
    protected $userService;

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

    /**
     * @var RepositoryManager
     */
    protected $rm;

    public function __construct(
        EntityManager $entityManager,
        HttpRequest $request,
        SessionInterface $session,
        Router $router,
        ConfigInterface $config,
        LoggedUserServiceInterface $userService,
        FrontController $frontController,
        ViewInterface $view,
        MessageBoxInterface $flash,
        RepositoryManager $rm
    ) {
        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->session = $session;
        $this->router = $router;
        $this->config = $config;
        $this->userService = $userService;
        $this->frontController = $frontController;
        $this->view = $view;
        $this->flash = $flash;
        $this->rm = $rm;
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
            'userService' => $this->userService,
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
        return $this->userService->isLogged();
    }

    protected function requestParam($name, $default = null)
    {
        return $this->router->parameter($name, $default);
    }


}