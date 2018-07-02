<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 21.06.18
 * Time: 22:10
 */

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="article")
 **/
class Article
{

    /**
     * @var integer
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string", length=150)
     */
    protected $title;

    /**
     * @var string
     *
     * @Column(type="text")
     */
    protected $body;

    /**
     * @var User
     *
     * @ManyToOne(targetEntity="User")
     */
    protected $user;

    public function __construct()
    {
        $this->title = '';
        $this->body = '';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId(int $id): Article
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Article
     */
    public function setBody(string $body): Article
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Article
     */
    public function setUser(User $user): Article
    {
        $this->user = $user;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->user ? $this->user->getId() : 0;
    }

}