<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 23.06.18
 * Time: 19:13
 */

namespace Classes;


use Core\Request\HttpRequest;
use DI\Annotation\Inject;

class Bar
{
    /**
     * @var Foo
     * @Inject
     */
    protected $foo;

    /**
     * @var string
     * @Inject("db.host")
     *
     */
    protected $host;

    /**
     * @var array
     *
     * @Inject("request.get")
     */
    protected $getVars;


    /**
     * Bar constructor
     */
    public function __construct(HttpRequest $request)
    {
    }


    public function __toString()
    {
        return $this->foo->getName() . ' host:  ' . $this->host;
    }

}