<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 13:53
 */

namespace Core\User;

interface UserInterface
{
    public function getName(): string;

    public function setName($value): User;

    public function getRoles(): array;

    public function setRoles(array $value): User;

    public function getPassword(): string;

    public function setPassword(string $value): User;

    public function hasCredentials($role): bool;

    public function getId();

    /**
     * @return \Entity\User
     * @throws UserNotExistsException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getEntity();
}