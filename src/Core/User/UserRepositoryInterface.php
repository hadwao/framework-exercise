<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 18:05
 */

namespace Core\User;

interface UserRepositoryInterface
{
    public function find($id);

    public function anonymouse(): User;
}