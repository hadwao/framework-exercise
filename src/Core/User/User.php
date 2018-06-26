<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 13:41
 */

namespace Core\User;


use Doctrine\ORM\EntityManager;

class User implements UserInterface
{
    /**
     * @var \Entity\User
     */
    private $entity = null;

    private $id = null;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager, $userId)
    {
        $this->id = $userId;
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Entity\User
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    private function loadEntity(): \Entity\User
    {
        if ((!$this->entity)&&($this->id)) {
            $this->entity = $this->entityManager->find(\Entity\User::class, $this->id);
        }

        if (!$this->entity) {
            throw new UserNotExistsException('User with given ID does not exist');
        }

        return $this->entity;
    }

    /**
     * @return string
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getName(): string
    {
        return $this->loadEntity()->getName();
    }

    /**
     * @param $value
     * @return User
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function setName($value): User
    {
        $this->loadEntity()->setName($value);
        return $this;
    }

    /**
     * @return array
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getRoles(): array
    {
        return $this->loadEntity()->getRoles();
    }

    /**
     * @param array $value
     * @return User
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function setRoles(array $value): User
    {
        $this->loadEntity()->setRoles($value);
        return $this;
    }

    /**
     * @return string
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getPassword(): string
    {
        return $this->loadEntity()->getPassword();
    }

    /**
     * @param string $value
     * @return User
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function setPassword(string $value): User
    {
        $this->loadEntity()->setPassword($value);
        return $this;
    }

    /**
     * @param $role
     * @return bool
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function hasCredentials($role): bool
    {
        return $this->loadEntity()->hasCredentials($role);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Entity\User
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getEntity()
    {

        return $this->loadEntity();
    }


}