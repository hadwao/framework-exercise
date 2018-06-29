<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 21.06.18
 * Time: 17:46
 */

namespace Core\Request;



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
     * SERVER parameters
     * @var array
     */
    protected $server = [];


    public function __construct(array $post, array $get, array $server)
    {
        $this->post = $post;
        $this->get = $get;
        $this->server = $server;
    }

    public function isPost(): bool
    {
        return isset($this->server['REQUEST_METHOD'])
            && $this->server['REQUEST_METHOD'] == 'POST';
    }

    public function postValue($name, $default = null)
    {
        return $this->post[$name] ?? $default;
    }

    public function serverValue($value, $default = null)
    {
        return $this->server[$value] ?? $default;
    }
}