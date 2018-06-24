<?php
use Psr\Container\ContainerInterface;
use function DI\factory;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

return [
    'Core\Request\HttpRequest' => function() {
        return new Core\Request\HttpRequest($_POST, $_GET, $_SERVER, $_SESSION);
    },

    'Core\AppConf' => function(\DI\Container $e) {
        return new Core\AppConf($e->get('app'));
    },

    //TODO: Czy to dobre rozwiązanie?
    'Entity\User' => function(\Core\Session $session, EntityManager $em) {
        if ($session->getParameter('user_id')){
            return $em->find(\Entity\User::class,$session->getParameter('user_id'));
        }
        else {
            return null;
        }
    },

    'Doctrine\ORM\EntityManager' => function(\DI\Container $e) {
        $config = Setup::createAnnotationMetadataConfiguration(
            array(APP_ROOT_DIR .'/src/Entity'), $e->get('app')['dev_mode']);

        $connectionParams = array(
            'dbname' => $e->get('db.name'),
            'user' => $e->get('db.user'),
            'password' => $e->get('db.password'),
            'host' => $e->get('db.host'),
            'driver' => $e->get('db.driver'),
            'charset'  => 'utf8',
            'driverOptions' => array(
                1002 => 'SET NAMES utf8'
            )
        );

        return EntityManager::create($connectionParams, $config);
    }

];