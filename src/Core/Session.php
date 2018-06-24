<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:54
 */

namespace Core;


class Session
{

    private $flashNamespace = 'flash';
    private $flashesToRemove = [];

    public function __construct()
    {
    }

    public function __destruct()
    {
        foreach ($this->flashesToRemove as $flashName) {
            if (isset($_SESSION[$this->flashNamespace][$flashName]))
            {
                unset($_SESSION[$this->flashNamespace][$flashName]);
            }
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

    public function setFlash(string $name, $value)
    {
        $this->preventFlashRemove($name);
        $_SESSION[$this->flashNamespace][$name] = $value;
    }

    private function preventFlashRemove(string $name)
    {
        if (($key = array_search($name, $this->flashesToRemove)) !== false) {
            unset($this->flashesToRemove[$key]);
        }
    }

    public function getFlashes()
    {
        $flashes = $_SESSION[$this->flashNamespace];
        foreach ($flashes as $key => $value) {
            $this->setFlashToRemove($key);
        }

        return $flashes;
    }

    public function getFlash(string $name, $default = null)
    {
        $this->setFlashToRemove($name);
        return $_SESSION[$this->flashNamespace][$name] ?? $default;
    }

    public function hasFlash(string $name): bool
    {
        return isset($_SESSION[$this->flashNamespace][$name]);
    }

    private function setFlashToRemove($name)
    {
        if (!isset($this->flashesToRemove[$name])){
            $this->flashesToRemove[] = $name;
        }
    }

    public function unsetParameter($name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }


}