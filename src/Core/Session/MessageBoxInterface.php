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
    public function addMessage(string $type, $msg);

    public function allMessages();
}