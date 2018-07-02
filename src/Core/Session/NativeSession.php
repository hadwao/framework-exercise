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
    /**
     * @var bool
     */
    protected $isInitialized = false;

    public function get(string $key, $namespace = null, $default = null)
    {
        $this->ensureInitialized();

        if ($namespace) {
            return $_SESSION[$namespace][$key] ?? $default;
        } else {
            return $_SESSION[$key] ?? $default;
        }
    }

    public function set(string $key, $value, $namespace = null)
    {
        $this->ensureInitialized();

        if ($namespace){
            $_SESSION[$namespace][$key] = $value;
            return;
        }

        $_SESSION[$key] = $value;
    }

    public function has($key, $namespace = null):bool
    {
        $this->ensureInitialized();

        if ($namespace) {
            return isset($_SESSION[$namespace][$key]);
        }
        return isset($_SESSION[$key]);
    }

    public function remove($key, $namespace = null)
    {
        $this->ensureInitialized();

        if ($namespace) {
            unset($_SESSION[$namespace][$key]);
            return;
        }

        unset($_SESSION[$key]);
    }

    protected function ensureInitialized()
    {
        if ($this->isInitialized || session_status() == PHP_SESSION_ACTIVE) {
            return;
        }

        session_start();
    }
}