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
    /**
     * @var ConfigInterface
     */
    protected $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function create(): TwigView
    {
        $options = [
            'debug' => true,
        ];

        if (!$this->config->get('dev_mode')) {
            $options['cache'] = APP_ROOT_DIR . '/var/cache/twig';
        }

        $loader = new \Twig_Loader_Filesystem(APP_ROOT_DIR .'/src/View');
        $twig = new \Twig_Environment($loader, $options);

        return new TwigView($twig);
    }
}