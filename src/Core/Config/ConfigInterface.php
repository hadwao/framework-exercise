<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 15:33
 */

namespace Core\Config;

interface ConfigInterface
{
    /**
     * @return mixed
     */
    public function get($name, $default = null);
}