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
    public function getParameter(string $name, $namespace = null, $default = null);

    public function setParameter(string $name, $value, $namespace = null);

    public function unsetParameter($name, $namespace = null);

    public function hasParameter($name, $namespace): bool;
}