<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 29.06.18
 * Time: 19:57
 */

namespace Core;


use DI\Container;

class RepositoryManager
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get(string $repositoryInterface)
    {
        return $this->container->get($repositoryInterface);
    }
}