<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 15:17
 */

namespace Core\View;



use Core\Config\ConfigInterface;

class TwigFactory
{
    public function __construct(ConfigInterface $conf)
    {
        $this->conf = $conf;
    }

    public function create()
    {
        $loader = new \Twig_Loader_Filesystem(APP_ROOT_DIR .'/src/View');
        $options = [];
        $options['debug'] = true;

        if ($this->conf->getParameter('dev_mode') == false) {
            $options['cache'] = APP_ROOT_DIR . '/var/cache/twig';
        }

        $twig = new \Twig_Environment($loader, $options);

        return new \Core\View\TwigView($twig);
    }
}