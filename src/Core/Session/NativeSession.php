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
    private $isStarded = false;

    private function startSession()
    {
        if (($this->isStarded == false) && (session_status() != PHP_SESSION_ACTIVE)) {
            session_start();
            $this->isStarded = true;
        }
    }

    public function getParameter(string $name, $namespace = null, $default = null)
    {
        $this->startSession();
        if ($namespace) {
            return $_SESSION[$namespace][$name] ?? $default;
        } else {
            return $_SESSION[$name] ?? $default;
        }
    }

    public function setParameter(string $name, $value, $namespace = null)
    {
        $this->startSession();
        if ($namespace){
            $_SESSION[$namespace][$name] = $value;
        }
        else {
            $_SESSION[$name] = $value;
        }
    }

    public function hasParameter($name, $namespace):bool
    {
        $this->startSession();
        if ($namespace) {
            return isset($_SESSION[$namespace][$name]);
        } else {
            return isset($_SESSION[$name]);
        }
    }


    public function unsetParameter($name, $namespace = null)
    {
        $this->startSession();
        if ($namespace) {
            if (isset($_SESSION[$namespace][$name])) {
                unset($_SESSION[$namespace][$name]);
            }
        }
        else {
            if (isset($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
        }
    }
}