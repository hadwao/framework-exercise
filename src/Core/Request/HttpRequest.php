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
     * HttpRequest constructor.
     * @param array $post
     * @param array $get
     * @param array $server
     */
    public function __construct(array $post, array $get, array $server)
    {
        $this->post = $post;
        $this->get = $get;
        $this->server = $server;
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


    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->server['REQUEST_SCHEME'] .'://'. $this->server['HTTP_HOST'];
    }

    public function getServerValue($value, $default = null)
    {
        return $this->server[$value] ?? null;
    }
}