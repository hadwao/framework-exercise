<?php
namespace Core;

use Core\Dispatcher\Dispatcher;
use Core\Dispatcher\PageNotFoundException;
use Core\Exception\AccessForbiddenException;
use Core\Request\HttpRequest;
use Entity\User;

class FrontController
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var AppConf
     */
    private $config;

    /**
     * @var User
     */
    private $user;

    /**
     * @var HttpRequest
     */
    private $request;

    public function __construct(HttpRequest $request, Dispatcher $dispatcher, AppConf $config, User $user = null)
    {
        $this->dispatcher = $dispatcher;
        $this->config = $config;
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        try {
            echo $this->dispatcher->dispatch();
        }

        catch (AccessForbiddenException $e)
        {
            http_response_code(403);
            $this->rethrowExceptionIfDevMode($e);
        }

        catch (PageNotFoundException $e) {
            http_response_code(404);
            $this->rethrowExceptionIfDevMode($e);
        }

        catch (\Exception $e)
        {
            http_response_code(500);
            $this->rethrowExceptionIfDevMode($e);
        }
    }

    private function rethrowExceptionIfDevMode(\Exception $e) {
        if ($this->config->getParameter('dev_mode')) {
            throw $e;
        }
    }

    public function redirect(string $uri)
    {
        header("Location: " . $this->getBaseUrl() . $uri);
        exit();
    }

    /**
     * @throws PageNotFoundException
     */
    public function forward404()
    {
        http_response_code(404);
        throw new PageNotFoundException('Strona nie została znaleziona');

    }

    /**
     * @throws AccessForbiddenException
     */
    public function forward403()
    {
        http_response_code(403);
        throw new AccessForbiddenException('Nie masz dostępu do tej strony');
    }

    /**
     * @throws AccessForbiddenException
     */
    public function forward403IfNotSigned() {
        if ((!$this->user) || (!$this->user->hasCredentials('user'))) {
            $this->forward403();
        }
    }

    public function getBaseurl(): string
    {
        return $this->request->getServerValue('REQUEST_SCHEME')
            .'://'.
            $this->request->getServerValue('HTTP_HOST');
    }

}