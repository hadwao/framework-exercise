<?php
namespace Controller;


use Core\AppConf;
use Core\FrontController;
use Core\Request\HttpRequest;
use Core\Router;
use Core\Session;
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
     * @var Session
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
        $loader = new \Twig_Loader_Filesystem(APP_ROOT_DIR .'/src/View');
        $options = [];

        if ($this->config->getParameter('dev_mode') == false) {
            $options['cache'] = APP_ROOT_DIR . '/var/cache/twig';
        }

        $twig = new \Twig_Environment($loader, $options);

        $template = $twig->load($template);

        $globalVars = [
            'user' =>$this->user,
            'session' => $this->session,
        ];
        return $template->render(array_merge($vars, $globalVars));
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
        $this->frontController->redirect($uri);
    }

        /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->getUser();
    }

    protected function getParameter($name, $default = null)
    {
        return $this->router->getParameter($name, $default);
    }


}