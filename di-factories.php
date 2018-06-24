<?php
use Psr\Container\ContainerInterface;
use function DI\factory;

return [
    'Core\Request\HttpRequest' => function() {
        return new Core\Request\HttpRequest($_POST, $_GET, $_SERVER, $_SESSION);
    },

];