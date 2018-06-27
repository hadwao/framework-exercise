<?php
/**
 * @license http://creatuity.com/license
 * @copyright Copyright (c) 2008-2018 Creatuity Corp. (http://www.creatuity.com/)
 */

namespace Core\Config;


use DI\Container;

class AppConfFactory
{

    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    public function create(): AppConf
    {
        $config = $this->container->get('app');
        if (!$config) {
            throw new \Exception("Cannot initialize AppConf: missing 'app' config");
        }
        return new AppConf($config);
    }

}