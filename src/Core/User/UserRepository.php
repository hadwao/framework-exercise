<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 17:54
 */

namespace Core\User;


use Doctrine\ORM\EntityManager;
class NotFoundException extends \Exception {}
class UserRepository implements UserRepositoryInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var User
     */
    protected $anonymous;

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
            throw new NotFoundException('No user with given ID');
        }

        $user = $this->buildUserFromEntity($entity);

        return $user;
    }

    public function findByName($name): User
    {
        /**
         * @var \Entity\User $entity;
         */
        $entity = $this->em->getRepository(User::class)
            ->findOneBy([
                'name' => $name,
            ]);

        if (!$entity) {
            throw new NotFoundException ('No user with given ID');
        }

        $user = $this->buildUserFromEntity($entity);

        return $user;
    }

    public function findByNameAndPassword($name, $password): User
    {
        /**
         * @var \Entity\User $entity;
         */
        $entity = $this->em->getRepository(\Entity\User::class)
            ->findOneBy([
                'name' => $name,
                'password' => $password,
            ]);


        if (!$entity) {
            throw new NotFoundException ('No user with given name and password');
        }

        $user = $this->buildUserFromEntity($entity);

        return $user;
    }

    public function anonymous(): User
    {
        if (!$this->anonymous) {
            $this->anonymous = new User();
        }
        return $this->anonymous;
    }

    protected function buildUserFromEntity(\Entity\User $entity): User
    {
        $user = new User();
        $user->setId($entity->getId());
        $user->setRoles($entity->getRoles());
        $user->setName($entity->getName());
        return $user;
    }
}