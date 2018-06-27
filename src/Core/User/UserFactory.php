<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 14:49
 */

namespace Core\User;


use Core\Session\SessionInterface;
use DI\Container;

class UserFactory
{

    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function create(): User
    {
        return $this->container->get(User::class);
    }

}