<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 28.06.18
 * Time: 18:05
 */

namespace Repository;

use Repository\NotFoundException;
use Entity\User;

interface UserRepositoryInterface
{

    /**
     * @throws NotFoundException
     */
    public function find($id);

    /**
     * @throws NotFoundException
     */
    public function findByName($name);

    /**
     * @throws NotFoundException
     */
    public function findByNameAndPassword($name, $password): User;

}