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

    /**
     * @param int $responseCode
     * @return HttpResponse
     */
    public function setResponseCode(int $responseCode): HttpResponse;

    /**
     * @return null|string
     */
    public function getBody(): ?string;

    /**
     * @param null|string $body
     * @return HttpResponse
     */
    public function setBody(?string $body): HttpResponse;

    /**
     * @return null|string
     */
    public function getRedirectUrl(): ?string;

    /**
     * @param null|string $redirectUrl
     * @return HttpResponse
     */
    public function setRedirectUrl(?string $redirectUrl): HttpResponse;

    public function process();
}