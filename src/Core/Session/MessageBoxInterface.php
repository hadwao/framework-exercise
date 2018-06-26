<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 10:49
 */

namespace Core\Session;

interface MessageBoxInterface
{
    public function setFlash(string $name, $value);

    public function getFlashes();

    public function getFlash(string $name, $default = null);

    public function hasFlash(string $name): bool;
}