<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 17:54
 */

namespace Core\User;


use Doctrine\ORM\EntityManager;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function find($id = null): User
    {
        /**
         * @var \Entity\User $entity;
         */
        $entity = $this->em->find(\Entity\User::class, $id);

        if (!$entity) {
            throw new \Exception('No user with given ID');
        }

        $user = $this->buildUserFromEntity($entity);

        return $user;
    }

    public function anonymouse(): User
    {
        return new User();
    }

    protected function buildUserFromEntity(\Entity\User $entity): User
    {
        $user = new User();
        $user->id = $entity->getId();
        $user->roles = $entity->getRoles();
        $user->name = $entity->getName();
        return $user;
    }
}