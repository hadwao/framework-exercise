<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 15:20
 */

namespace Core\Db;


use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return EntityManager
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @throws \Doctrine\ORM\ORMException
     */
    public function create()
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            array(APP_ROOT_DIR .'/src/Entity'), $this->container->get('app')['dev_mode']);

        $connectionParams = array(
            'dbname' => $this->container->get('db.name'),
            'user' => $this->container->get('db.user'),
            'password' => $this->container->get('db.password'),
            'host' => $this->container->get('db.host'),
            'driver' => $this->container->get('db.driver'),
            'charset'  => 'utf8',
            'driverOptions' => array(
                1002 => 'SET NAMES utf8'
            )
        );

        return EntityManager::create($connectionParams, $config);
    }
}