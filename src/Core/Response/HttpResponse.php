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
     * @var string
     */
    protected $body = '';

    /**
     * @var string[]
     */
    protected $headers = [];

    public function __construct(string $body, array $headers = [])
    {
        $this->body = $body;
        $this->headers = $headers;
    }

    public function process()
    {
        http_response_code(200);
        foreach($this->headers as $name => $value) {
            header("{$name}:{$value}");
        }
        echo $this->body;
    }

}