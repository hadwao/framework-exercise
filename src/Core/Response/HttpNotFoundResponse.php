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
    public function __construct()
    {
        $this->responseCode = 404;
    }

    public function process()
    {
        http_response_code($this->responseCode);
        throw new PageNotFoundException('Requested page was not found');
    }
}