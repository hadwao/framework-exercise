<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 10:44
 */

namespace Core\Session;

interface SessionInterface
{
    public function get(string $key, $namespace = null, $default = null);

    public function set(string $key, $value, $namespace = null);

    public function remove($key, $namespace = null);

    public function has($key, $namespace = null): bool;
}