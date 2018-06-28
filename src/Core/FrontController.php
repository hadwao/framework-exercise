<?php
namespace Core;

use Core\Config\ConfigInterface;
use Core\Dispatcher\Dispatcher;
use Core\Dispatcher\PageNotFoundException;
use Core\Exception\AccessForbiddenException;
use Core\Request\HttpRequest;
use Core\Response\HttpResponse;
use Core\Response\ResponseInterface;
use Core\User\User;
use Core\User\UserInterface;
use DI\Annotation\Inject;

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
     * @var UserInterface
     */
    protected $user;

    /**
     * @var HttpRequest
     */
    protected $request;

    public function __construct(HttpRequest $request, Dispatcher $dispatcher, ConfigInterface $config, User $user)
    {
        $this->dispatcher = $dispatcher;
        $this->config = $config;
        $this->user = $user;
        $this->request = $request;
    }

    public function run()
    {
        try {
            $response = $this->dispatcher->dispatch();

            if (! $response instanceof ResponseInterface) {
                throw new \Exception('Controller must return Response object');
            }

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

    public function redirect(string $uri): ResponseInterface
    {
        #todo: new RedirectHttpResponse()
        $response = new HttpResponse();
        return $response->setRedirectUrl($this->baseUrl() . $uri);
    }

    public function forward404()
    {
        #todo: new Http404Response()
        $response = new HttpResponse();
        return $response->setResponseCode(404);

    }

    public function forward403()
    {
        #todo: new Http403Response()
        $response = new HttpResponse();
        return $response->setResponseCode(403);
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