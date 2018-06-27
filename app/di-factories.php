<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

return [
    \Core\Session\SessionInterface::class => \Di\autowire(\Core\Session\NativeSession::class),

    \Core\Session\MessageBoxInterface::class => \Di\autowire(\Core\Session\MessageBox::class),

    \Core\Request\HttpRequest::class => \Di\autowire(\Core\Request\DefaultHttpRequest::class),

    \Core\User\UserInterface::class => \Di\autowire(\Core\User\User::class),

    \Core\Config\ConfigInterface::class => DI\factory([\Core\Config\AppConfFactory::class, 'create']),

    \Core\View\ViewInterface::class => DI\factory([\Core\View\TwigFactory::class, 'create']),

    \Doctrine\ORM\EntityManager::class => DI\factory([\Core\Db\EntityManagerFactory::class, 'create']),
];
