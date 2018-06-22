<?php
include 'vendor/autoload.php';
include 'app/config.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration(array(APP_ROOT_DIR .'/src/Entity'), APP_DEV_MODE);

$connectionParams = array(
    'dbname' => APP_DB_NAME,
    'user' => APP_DB_USER,
    'password' => APP_DB_PASSWORD,
    'host' => APP_DB_HOST,
    'driver' => APP_DB_DRIVER,
    'charset'  => 'utf8',
    'driverOptions' => array(
        1002 => 'SET NAMES utf8'
    )
);

$entityManager = EntityManager::create($connectionParams, $config);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
