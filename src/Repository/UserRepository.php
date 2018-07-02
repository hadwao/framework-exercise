<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 30.06.18
 * Time: 12:02
 */

namespace Repository;

use Doctrine\ORM\EntityManager;
use Entity\User;

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
         * @var \Entity\User $entity ;
         */
        $entity = $this->em->find(\Entity\User::class, $id);

        if (!$entity) {
            throw new NotFoundException('No user with given ID');
        }


        return $entity;
    }

    public function findByName($name): User
    {
        /**
         * @var \Entity\User $entity ;
         */
        $entity = $this->em->getRepository(User::class)
            ->findOneBy([
                'name' => $name,
            ]);

        if (!$entity) {
            throw new NotFoundException ('No user with given ID');
        }


        return $entity;
    }

    public function findByNameAndPassword($name, $password): User
    {
        /**
         * @var \Entity\User $entity ;
         */
        $entity = $this->em->getRepository(\Entity\User::class)
            ->findOneBy([
                'name' => $name,
                'password' => $password,
            ]);


        if (!$entity) {
            throw new NotFoundException ('No user with given name and password');
        }


        return $entity;
    }
}