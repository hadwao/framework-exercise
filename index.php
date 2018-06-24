<?php
require 'vendor/autoload.php';
require 'app/config.php';
session_start();

$builder = new \DI\ContainerBuilder();
$builder->useAnnotations(true);
$builder->addDefinitions('di-parameters.php');
$builder->addDefinitions('di-factories.php');
$container = $builder->build();

$frontController = $container->get('Core\\FrontController');
$frontController->run();




