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
    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->config[$name] ?? $default;
    }

}