<?php
namespace Core;

use Core\Config\ConfigInterface;
use Core\Dispatcher\Dispatcher;
use Core\Dispatcher\PageNotFoundException;
use Core\Exception\AccessForbiddenException;
use Core\Request\HttpRequest;
use Core\Response\HttpForbiddenResponse;
use Core\Response\HttpNotFoundResponse;
use Core\Response\HttpRedirectResponse;
use Core\Response\ResponseInterface;
use Core\User\LoggedUserServiceInterface;

class FrontController
{
    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var LoggedUserServiceInterface
     */
    protected $userService;

    /**
     * @var HttpRequest
     */
    protected $request;

    public function __construct(HttpRequest $request,
        Dispatcher $dispatcher,
        ConfigInterface $config,
        LoggedUserServiceInterface $userService)
    {
        $this->dispatcher = $dispatcher;
        $this->config = $config;
        $this->userService = $userService;
        $this->request = $request;
    }

    public function run()
    {
        try {
            $response = $this->dispatcher->dispatch();

            $response->process();

        } catch (AccessForbiddenException $e) {
            $this->handleError($e, 403);
        } catch (PageNotFoundException $e) {
            $this->handleError($e, 404);
        } catch (\Exception $e) {
            $this->handleError($e, 500);
        }
    }

    protected function handleError(\Exception $e, $httpCode = 500)
    {
        if ($httpCode) {
            http_response_code($httpCode);
        }

        if ($this->config->get('dev_mode')) {
            throw $e;
        }
        throw new \Exception("Application Error");
    }

}