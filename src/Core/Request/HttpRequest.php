<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 21.06.18
 * Time: 17:46
 */

namespace Core\Request;



use Entity\User;

class HttpRequest
{
    /**
     * POST parameters
     * @var array
     */
    protected $post = [];

    /**
     * GET parameters
     * @var array
     */
    protected $get = [];

    /**
     * @var array
     */
    protected $server = [];

    /**
     * Session parameters
     * @var array
     */
    protected $session = [];

    /**
     * HttpRequest constructor.
     * @param array $post
     * @param array $get
     * @param array $server
     * @param array $session
     */
    public function __construct(array $post, array $get, array $server, array $session)
    {
        $this->post = $post;
        $this->get = $get;
        $this->server = $server;
        $this->session = $session;
    }

    /**
     * @return string
     */
    public function getControllerClass(): string
    {
        return 'Controller\\' . ucfirst($this->getControllerName()) . 'Controller';
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->getActionName() . 'Action';
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        $uriParts = $this->getUriParts();
        return $uriParts[0] ?? APP_DEFAULT_CONTROLLER;
    }


    /**
     * @return string
     */
    public function getActionName(): string
    {
        $uriParts = $this->getUriParts();
        return $uriParts[1] ?? APP_DEFAULT_ACTION;
    }

    /**
     * @return array
     */
    protected function getUriParts(): array
    {
        $parts = explode('/', $this->server['REQUEST_URI']);
        return array_values(array_filter($parts));
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        $parts = $this->getUriParts();

        $parameters = [];

        if (count($parts) > 2) {
            for ($i=2; $i<count($parts); $i = $i+2) {
                $parameters[$parts[$i]] = $parts[$i+1] ?? null;
            }
        }

        return $parameters;
    }

    /**
     * @param $name
     * @param null $default
     * @return string
     */
    public function getParameter($name, $default = null): string
    {
        return $this->getParameters()[$name] ?? $default;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    public function getPostValue($name, $default = null)
    {
        return $this->post[$name] ?? $default;
    }

    public function getSessionValue($name, $default = null)
    {
        return $this->session[$name] ?? $default;
    }

    /**
     * @return mixed|null
     */
    public function getLoggedUserId()
    {
        return $this->getSessionValue('user_id');

    }

    /**
     * @param int $id
     */
    public function setLoggedUserId(int $id)
    {
        $_SESSION['user_id'] = $id;
    }

    /**
     * @return mixed
     */
    public function unsetLoggedUserId()
    {
        unset($_SESSION['user_id']);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->server['REQUEST_SCHEME'] .'://'. $this->server['HTTP_HOST'];
    }
}