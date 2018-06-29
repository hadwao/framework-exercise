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
}