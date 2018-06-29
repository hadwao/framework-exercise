<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 17:15
 */

namespace Core\User;


use Core\Session\SessionInterface;

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
    protected $user;

    public function __construct(SessionInterface $session, UserRepositoryInterface $userRepository)
    {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function user(): User
    {
        if (!$this->user) {
            $this->user = $this->fetchLoggedOrAnonymouse();
        }
        return $this->user;
    }

    public function isLogged(): bool
    {
        return (bool) $this->session->get('user_id');
    }

    public function login(int $id)
    {
        $this->session->set('user_id', $id);
        $this->id = $id;
    }

    public function logout()
    {
        $this->session->remove('user_id');
    }

    public function hasCredentials(string $role): bool
    {
        return in_array($role, $this->user()->roles);
    }

    protected function fetchLoggedOrAnonymouse(): User
    {
        if ($this->session->get('user_id')) {
            $user = $this->userRepository->find($this->session->get('user_id'));
        } else {
            $user = $this->userRepository->anonymouse();
        }

        return $user;
    }




}