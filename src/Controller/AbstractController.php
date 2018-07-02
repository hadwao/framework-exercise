<?php

namespace Controller;


use Core\Config\ConfigInterface;
use Core\Dispatcher\PageNotFoundException;
use Core\Exception\AccessForbiddenException;
use Core\FrontController;
use Core\Request\HttpRequest;
use Core\Response\HttpForbiddenResponse;
use Core\Response\HttpNotFoundResponse;
use Core\Response\HttpRedirectResponse;
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

    public function __construct(
        EntityManager $entityManager,
        HttpRequest $request,
        SessionInterface $session,
        Router $router,
        ConfigInterface $config,
        LoggedUserServiceInterface $userService,
        FrontController $frontController,
        ViewInterface $view,
        MessageBoxInterface $flash
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
    }

    protected function renderView($template, $vars = []): ResponseInterface
    {
        $globalVars = [
            'userService' => $this->userService,
            'session' => $this->session,
            'flash' => $this->flash,
        ];
        $finalVars = array_merge($vars, $globalVars);
        $output = $this->view->renderView($template, $finalVars);

        return new HttpResponse($output);
    }

    protected function requestParam($name, $default = null)
    {
        return $this->router->parameter($name, $default);
    }

    public function redirect(string $uri): HttpRedirectResponse
    {
        return new HttpRedirectResponse($this->baseUrl() . $uri);
    }

    public function forward404(): HttpNotFoundResponse
    {
        return new HttpNotFoundResponse();
    }

    public function forward403(): HttpForbiddenResponse
    {
        return new HttpForbiddenResponse();
    }

    public function baseUrl(): string
    {
        #TODO: move to App class
        return sprintf("%s://%s",
            $this->request->serverValue('REQUEST_SCHEME'),
            $this->request->serverValue('HTTP_HOST')
        );
    }


}