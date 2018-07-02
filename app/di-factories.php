<?php
return [
    # Core
    \Core\Request\HttpRequest::class => \Di\autowire(\Core\Request\DefaultHttpRequest::class),

    \Core\Session\SessionInterface::class => \Di\autowire(\Core\Session\NativeSession::class),

    \Core\Session\MessageBoxInterface::class => \Di\autowire(\Core\Session\MessageBox::class),

    \Core\Config\ConfigInterface::class => DI\factory([\Core\Config\AppConfFactory::class, 'create']),

    \Core\View\ViewInterface::class => DI\factory([\Core\View\TwigFactory::class, 'create']),

    # Doctrine
    \Doctrine\ORM\EntityManager::class => DI\factory([\Core\Db\EntityManagerFactory::class, 'create']),


    # Services
    \Core\User\LoggedUserServiceInterface::class => \DI\autowire(\Core\User\LoggedUserService::class),


    # Repositories
    \Repository\UserRepositoryInterface::class => \DI\autowire(Repository\UserRepository::class),

    \Repository\ArticleRepositoryInterface::class => \DI\autowire(\Repository\ArticleRepository::class),
];
