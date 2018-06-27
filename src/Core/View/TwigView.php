<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 25.06.18
 * Time: 15:19
 */

namespace Core\View;


class TwigView implements ViewInterface
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;


    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param string $template
     * @param array $vars
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderView(string $template, array $vars): string
    {
        $template .= '.html.twig';
        $t = $this->twig->load($template);
        return $t->render($vars);
    }

    public function renderText(string $text): string
    {
        // TODO: Implement renderText() method.
    }
}