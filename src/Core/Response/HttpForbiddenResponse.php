<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 29.06.18
 * Time: 13:17
 */

namespace Core\Response;


use Core\Exception\AccessForbiddenException;

class HttpForbiddenResponse extends AbstractHttpResponse
{
    public function __construct()
    {
        $this->responseCode = 403;
    }

    public function process()
    {
        http_response_code($this->responseCode);

        throw new AccessForbiddenException('You have no access rights do display this page');
    }


}