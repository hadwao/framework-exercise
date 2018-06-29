<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 17:07
 */

namespace Core\User;

class User
{
    /**
     * @var string
     */
    public $name = 'Anonymous';

    /**
     * @var string[]
     */
    public $roles = [];

    /**
     * @var int|null
     */
    public $id = null;

    /**
     * @param int|null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string[] $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function hasRole($role): bool
    {
        return in_array($role, $this->roles);
    }
}