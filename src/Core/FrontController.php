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
use Core\Response\HttpResponse;
use Core\Response\ResponseInterface;
use Core\User\UserInterface;
use DI\Annotation\Inject;

class FrontController
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var HttpRequest
     */
    private $request;

    /**
     * FrontController constructor.
     * @param HttpRequest $request
     * @param Dispatcher $dispatcher
     * @param ConfigInterface $config
     * @param UserInterface $user
     *
     * @Inject
     *
     */
    public function __construct(HttpRequest $request, Dispatcher $dispatcher, ConfigInterface $config, $user)
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
            $response = $this->dispatcher->dispatch();

            if (! $response instanceof ResponseInterface) {
                throw new \Exception('Controller must return Response object');
            }

            $response->process();

        } catch (AccessForbiddenException $e)
        {
            $this->rethrowExceptionIfDevMode($e);
        } catch (PageNotFoundException $e) {
            $this->rethrowExceptionIfDevMode($e);
        } catch (\Exception $e) {
            http_response_code(500);
            $this->rethrowExceptionIfDevMode($e);
        }
    }

    /**
     * @param \Exception $e
     * @throws \Exception
     */
    private function rethrowExceptionIfDevMode(\Exception $e) {
        if ($this->config->getParameter('dev_mode')) {
            throw $e;
        }
    }

    public function redirect(string $uri): HttpRedirectResponse
    {
        $response = new HttpRedirectResponse();
        $response->setRedirectUrl($this->getBaseurl() . $uri);
        return $response;

    }

    /**
     * @throws PageNotFoundException
     */
    public function forward404(): HttpNotFoundResponse
    {
        return new HttpNotFoundResponse();

    }

    /**
     * @throws AccessForbiddenException
     */
    public function forward403(): HttpForbiddenResponse
    {
        return new HttpForbiddenResponse();
    }

    public function getBaseurl(): string
    {
        return $this->request->getServerValue('REQUEST_SCHEME')
            .'://'.
            $this->request->getServerValue('HTTP_HOST');
    }

}