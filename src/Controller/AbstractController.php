<?php
namespace Controller;


use Core\AppConf;
use Core\FrontController;
use Core\Request\HttpRequest;
use Core\Router;
use Core\Session\MessageBoxInterface;
use Core\Session\SessionInterface;
use Core\View\ViewInterface;
use DI\Annotation\Inject;
use Doctrine\ORM\EntityManager;
use Entity\User;



abstract class AbstractController
{
    /**
     * @var EntityManager
     * @Inject
     */
    protected $entityManager;

    /**
     * @var HttpRequest
     * @Inject
     */
    protected $request;

    /**
     * @var SessionInterface
     * @Inject
     */
    protected $session;

    /**
     * @var Router
     * @Inject
     */
    protected $router;

    /**
     * @var AppConf
     * @Inject
     */
    protected $config;

    /**
     * @var User
     * @Inject
     */
    protected $user;

    /**
     * @var FrontController
     * @Inject
     */
    protected $frontController;

    /**
     * @var ViewInterface
     * @Inject
     */
    protected $view;

    /**
     * @var MessageBoxInterface
     * @Inject
     */
    protected $flash;


    /**
     * @return HttpRequest
     */
    public function getRequest(): HttpRequest
    {
        return $this->request;
    }

    /**
     * @param $template
     * @param array $vars
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderView($template, $vars = []): string
    {
        $globalVars = [
            'user' => $this->user,
            'session' => $this->session,
            'flash' => $this->flash,
        ];
        return $this->view->renderView($template, array_merge($vars, $globalVars));
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    /**
     * @param $uri
     */
    public function redirect(string $uri)
    {
        return $this->frontController->redirect($uri);
    }

    protected function getParameter($name, $default = null)
    {
        return $this->router->getParameter($name, $default);
    }


}