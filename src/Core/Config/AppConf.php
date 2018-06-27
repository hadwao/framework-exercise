<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 24.06.18
 * Time: 15:56
 */

namespace Core\Config;


class AppConf implements ConfigInterface
{
    /**
     * @var array
     */
    protected $parameters;

    public function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    public function get($name, $default = null)
    {
        return $this->parameters[$name] ?? $default;
    }

}