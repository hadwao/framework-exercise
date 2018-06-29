<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 18:13
 */

namespace Core\User;

interface LoggedUserServiceInterface
{
    public function user(): User;

    public function isLogged(): bool;

    public function login(int $id);

    public function hasCredentials(string $role): bool;

    public function logout();
}