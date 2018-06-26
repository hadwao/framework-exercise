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
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return UserInterface|null
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function create()
    {
        if ($uid = $this->container->get(SessionInterface::class)->getParameter('user_id'))
        {
            return $this->container->get(User::class);
        } else {
            return null;
        }
    }

}