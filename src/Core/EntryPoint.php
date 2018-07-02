<?php
/**
 * @license http://creatuity.com/license
 * @copyright Copyright (c) 2008-2018 Creatuity Corp. (http://www.creatuity.com/)
 */

namespace Core;


use Core\FrontController;
use DI\ContainerBuilder;

class EntryPoint
{

    public static function run()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(APP_ROOT_DIR . '/app/parameters.php');
        $builder->addDefinitions(APP_ROOT_DIR . '/app/di.php');
        $container = $builder->build();

        $container->get(FrontController::class)->run();
    }

}