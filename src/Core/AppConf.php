<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 24.06.18
 * Time: 15:56
 */

namespace Core;


class AppConf
{
    /**
     * @var array
     */
    private $parameters;

    public function __construct($parameters)
    {
        $this->parameters = $parameters;
    }

    public function getParameter($name, $default = null)
    {
        return $this->parameters[$name] ?? $default;
    }

}