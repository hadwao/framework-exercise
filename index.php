<?php
require 'vendor/autoload.php';
require 'app/config.php';

define('APP_ROOT_DIR', __DIR__);

session_start();

$builder = new \DI\ContainerBuilder();
$builder->useAnnotations(true);
$builder->addDefinitions('app/parameters.php');
$builder->addDefinitions('app/di-factories.php');
$container = $builder->build();

$frontController = $container->get('Core\\FrontController');
$frontController->run();