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

class HttpResponse implements ResponseInterface
{
    /**
     * @var integer
     */
    protected $responseCode = 200;

    /**
     * @var string|null
     */
    protected $body = null;

    /**
     * @var string|null
     */
    protected $redirectUrl = null;

    /**
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    /**
     * @param int $responseCode
     * @return HttpResponse
     */
    public function setResponseCode(int $responseCode): HttpResponse
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param null|string $body
     * @return HttpResponse
     */
    public function setBody(?string $body): HttpResponse
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }

    /**
     * @param null|string $redirectUrl
     * @return HttpResponse
     */
    public function setRedirectUrl(?string $redirectUrl): HttpResponse
    {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }

    /**
     * @return null
     * @throws AccessForbiddenException
     * @throws PageNotFoundException
     */
    public function process()
    {
        if ($this->responseCode != 200) {
            http_response_code($this->responseCode);
            switch ($this->responseCode){
                case 403:
                    throw new AccessForbiddenException('Access forbidden for this page');
                case 404:
                    throw new PageNotFoundException('Page not found');
            }
            return null;
        }

        if ($this->redirectUrl) {
            header("Location: " . $this->redirectUrl);
        }

        echo $this->body;
    }



}