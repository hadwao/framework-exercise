<?php
namespace Controller;


use Core\AppConf;
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
    public function redirect($uri)
    {
        header("Location: " . $this->request->getBaseUrl() . $uri);
        die();
    }

    /**
     * Redirect to 404 page
     */
    public function redirect404()
    {
        http_response_code(404);
        die();
    }

    /**
     * Redirect to forbiden page
     */
    public function redirect403()
    {
        http_response_code(403);
        die();
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