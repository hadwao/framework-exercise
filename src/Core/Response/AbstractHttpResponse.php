<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 29.06.18
 * Time: 13:11
 */

namespace Core\Response;


abstract class AbstractHttpResponse implements ResponseInterface
{
    /**
     * @var int
     */
    protected $responseCode = 200;

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }
}