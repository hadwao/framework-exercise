<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 10:45
 */

namespace Core\Session;


class NativeMessageBox implements MessageBoxInterface
{
    private $flashNamespace = 'flash';

    private $flashesToRemove = [];

    public function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

    }

    public function __destruct()
    {
        foreach ($this->flashesToRemove as $flashName) {
            if (isset($_SESSION[$this->flashNamespace][$flashName]))
            {
                unset($_SESSION[$this->flashNamespace][$flashName]);
                die();
            }
        }
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
        $msg = $_SESSION[$this->flashNamespace][$name] ?? $default;

        $this->setFlashToRemove($name);
        return $msg;
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

}