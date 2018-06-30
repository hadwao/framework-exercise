<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 17:15
 */

namespace Core\User;


use Core\Session\SessionInterface;
use Entity\User;
use Repository\NotFoundException;
use Repository\UserRepositoryInterface;

class LoggedUserService implements LoggedUserServiceInterface
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var User
     */
    protected $loggedUser;

    public function __construct(SessionInterface $session, UserRepositoryInterface $userRepository)
    {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function user(): ?User
    {
        if (!$this->isLogged()) {
            return null;
        }

        if (!$this->loggedUser) {
            $this->loggedUser = $this->userRepository->find($this->userId());
        }

        return $this->loggedUser;
    }

    public function userId(): int
    {
        return $this->session->get('user_id', '', 0);
    }

    public function isLogged(): bool
    {
        return (bool)$this->userId();
    }

    public function login($name, $password): bool
    {
        try{
            $user = $this->userRepository->findByNameAndPassword($name, $password);
            if ($user) {
                $this->session->set('user_id', $user->getId());
            }
            return true;
        } catch(NotFoundException $e) {
            return false;
        }
    }

    public function logout()
    {
        $this->session->remove('user_id');
    }

    public function hasRole(string $role): bool
    {
        return $this->user()->hasRole($role);
    }

}