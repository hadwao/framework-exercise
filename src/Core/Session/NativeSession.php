<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:54
 */

namespace Core\Session;


class NativeSession implements SessionInterface
{
    public function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function getParameter(string $name, $default = null)
    {
        return $_SESSION[$name] ?? $default;
    }

    public function setParameter(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }


    public function unsetParameter($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
}