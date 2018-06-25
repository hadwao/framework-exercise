<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 24.06.18
 * Time: 12:15
 */

namespace Core;

use Core\Request\HttpRequest;

class Router
{
    /**
     * @var HttpRequest
     */
    private $request;

    /**
     * @var AppConf
     */
    private $config;

    public function __construct(HttpRequest $request, AppConf $config)
    {
        $this->request = $request;
        $this->config = $config;
    }

    public function getController(): string
    {
        return 'Controller\\' . ucfirst($this->getControllerName()) . 'Controller';
    }

    public function getAction(): string
    {
        return $this->getActionName() . 'Action';
    }

    public function getControllerName(): string
    {

        $uriParts = $this->getUriParts();
        return $uriParts[0] ?? $this->config->getParameter('default_controller');
    }


    public function getActionName(): string
    {
        $uriParts = $this->getUriParts();
        return $uriParts[1] ?? $this->config->getParameter('default_action');
    }

    private function stripGetParametersFromUri(string $uri): string
    {
        return substr($uri,0, strpos($uri, '?'));
    }

    private function getUriParts(): array
    {
        $parts = explode(
            '/',
            $this->stripGetParametersFromUri($this->request->getServerValue('REQUEST_URI')));
        return array_values(array_filter($parts));
    }

    public function getParameters(): array
    {
        $parts = $this->getUriParts();

        $parameters = [];

        if (count($parts) > 2) {
            for ($i = 2; $i < count($parts); $i = $i + 2) {
                $parameters[$parts[$i]] = $parts[$i + 1] ?? null;
            }
        }

        return $parameters;
    }

    public function getParameter($name, $default = null): string
    {
        return $this->getParameters()[$name] ?? $default;
    }
}