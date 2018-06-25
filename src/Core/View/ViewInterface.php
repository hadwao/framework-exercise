<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 25.06.18
 * Time: 15:17
 */

namespace Core\View;


interface ViewInterface
{
    public function renderView(string $template, array $vars): string;

    public function renderText(string $text): string ;
}