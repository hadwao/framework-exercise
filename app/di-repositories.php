<?php
return [
    \Repository\UserRepositoryInterface::class => \DI\autowire(Repository\UserRepository::class),

    \Repository\ArticleRepositoryInterface::class => \DI\autowire(\Repository\ArticleRepository::class),
];