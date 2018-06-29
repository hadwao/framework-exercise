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

    public function login($name, $password): bool;

    public function hasRole(string $role): bool;

    public function logout();

}