<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 21.06.18
 * Time: 22:10
 */

namespace Entity;

use DI\Annotation\Injectable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="user")
 * @Injectable(lazy=true)
 **/
class User
{

    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string", length=50)
     */
    protected $name;

    /**
     * @var string
     *
     * @Column(type="string", length=50)
     */
    protected $password;

    /**
     * @var
     *
     * @Column(type="array")
     */
    protected $roles;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function hasCredentials($role): bool
    {
        return in_array($role, $this->roles);
    }



}