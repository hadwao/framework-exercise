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
    public function getParameter(string $name, $default = null);

    public function setParameter(string $name, $value);

    public function unsetParameter($name);
}