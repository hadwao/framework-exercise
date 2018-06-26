<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 10:45
 */

namespace Core\Session;


class MessageBox implements MessageBoxInterface
{
    private $flashNamespace = 'flash';

    private $flashesToRemove = [];

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
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
        $this->session->setParameter($name,$value, $this->flashNamespace);
    }

    private function preventFlashRemove(string $name)
    {
        if (($key = array_search($name, $this->flashesToRemove)) !== false) {
            unset($this->flashesToRemove[$key]);
        }
    }

    public function getFlashes()
    {
        $flashes = $this->session->getParameter($this->flashNamespace);
        foreach ($flashes as $key => $value) {
            $this->setFlashToRemove($key);
        }
        return $flashes;
    }

    public function getFlash(string $name, $default = null)
    {
        $this->setFlashToRemove($name);
        return $this->session->getParameter($name, $this->flashNamespace, $default);

    }

    public function hasFlash(string $name): bool
    {
        return $this->session->hasParameter($name, $this->flashNamespace);
    }

    private function setFlashToRemove($name)
    {
        if (!isset($this->flashesToRemove[$name])){
            $this->flashesToRemove[] = $name;
        }
    }

}