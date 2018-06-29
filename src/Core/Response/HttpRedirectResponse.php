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
    public function setRedirectUrl(?string $redirectUrl): HttpRedirectResponse
    {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }

    public function process()
    {
        if (!$this->getRedirectUrl())
        {
            throw new \Exception('You must specify redirect url');
        }
        header("Location: " . $this->redirectUrl);
    }


}