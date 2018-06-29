<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 21:15
 */

namespace Core\Response;


use Core\Dispatcher\PageNotFoundException;
use Core\Exception\AccessForbiddenException;

class HttpResponse extends AbstractHttpResponse
{


    /**
     * @var string|null
     */
    protected $body = null;

    /**
     * @var string|null
     */
    protected $redirectUrl = null;


    public function __construct()
    {
        $this->responseCode = 200;
    }

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }
    public function setResponseCode(int $responseCode): HttpResponse
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): HttpResponse
    {
        $this->body = $body;
        return $this;
    }

    public function process()
    {
        http_response_code($this->responseCode);
        echo $this->body;
    }



}