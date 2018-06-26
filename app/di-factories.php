<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

return [
    'Core\Session\SessionInterface' => function() { return new \Core\Session\NativeSession();},

    'Core\Session\MessageBoxInterface' => function(\Core\Session\SessionInterface $session) {
        return new \Core\Session\MessageBox($session);
    },

    'Core\Config\ConfigInterface' => function(\DI\Container $e) { return new \Core\Config\AppConf($e->get('app')); },

    'Core\Request\HttpRequest' => function() { return new Core\Request\HttpRequest($_POST, $_GET, $_SERVER); },

    'Core\User\UserInterface' => DI\factory([\Core\User\UserFactory::class, 'create']),

    'Core\View\ViewInterface' => DI\factory([\Core\View\TwigFactory::class, 'create']),

    'Doctrine\ORM\EntityManager' => DI\factory([\Core\Db\EntityManagerFactory::class, 'create']),

];