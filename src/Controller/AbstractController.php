<?php
namespace Controller;


use Core\Request\HttpRequest;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Entity\User;

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
     * @var User
     */
    protected $user = null;

    /**
     * AbstractController constructor.
     * @param HttpRequest $request
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;

        $config = Setup::createAnnotationMetadataConfiguration(array(APP_ROOT_DIR .'/src/Entity'), APP_DEV_MODE);

        $connectionParams = array(
            'dbname' => APP_DB_NAME,
            'user' => APP_DB_USER,
            'password' => APP_DB_PASSWORD,
            'host' => APP_DB_HOST,
            'driver' => APP_DB_DRIVER,
            'charset'  => 'utf8',
            'driverOptions' => array(
                1002 => 'SET NAMES utf8'
            )
        );

        $this->entityManager = EntityManager::create($connectionParams, $config);

        if ($this->request->getLoggedUserId()){
            $this->user = $this
                ->getEntityManager()
                ->find(User::class, $this->request->getLoggedUserId());
        }

    }

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

        if (APP_DEV_MODE == false) {
            $options['cache'] = APP_ROOT_DIR . '/var/cache/twig';
        }

        $twig = new \Twig_Environment($loader, $options);

        $template = $twig->load($template);

        $globalVars = [
            'user' =>$this->user
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


}