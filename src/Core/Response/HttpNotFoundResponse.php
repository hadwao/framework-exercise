<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 29.06.18
 * Time: 13:09
 */

namespace Core\Response;


use Core\Dispatcher\PageNotFoundException;

class HttpNotFoundResponse extends AbstractHttpResponse
{
    public function process()
    {
        throw new PageNotFoundException('Requested page was not found');
    }
}