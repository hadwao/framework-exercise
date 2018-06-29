<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 21:21
 */

namespace Core\Response;

interface ResponseInterface
{
    /**
     * @return int
     */
    public function getResponseCode(): int;

    public function process();
}