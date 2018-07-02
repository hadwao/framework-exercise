<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 29.06.18
 * Time: 13:27
 */

namespace Core\Response;


class HttpRedirectResponse extends AbstractHttpResponse
{
    /**
     * @var string
     */
    protected $redirectUrl;

    public function __construct(string $redirectUrl)
    {
        $this->redirectUrl = $redirectUrl ?? '/';
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    public function process()
    {
        header("Location: " . $this->redirectUrl);
    }

}