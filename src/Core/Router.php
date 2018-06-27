<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 24.06.18
 * Time: 12:15
 */

namespace Core;

use Core\Config\ConfigInterface;
use Core\Request\HttpRequest;

class Router
{
    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var ConfigInterface
     */
    protected $config;


    public function __construct(HttpRequest $request, ConfigInterface $config)
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
        $uriParts = $this->uriParts();

        return $uriParts[0] ?? $this->config->get('default_controller');
    }

    public function getActionName(): string
    {
        $uriParts = $this->uriParts();

        return $uriParts[1] ?? $this->config->get('default_action');
    }

    public function parameter($name, $default = null): string
    {
        return $this->allParameters()[$name] ?? $default;
    }

    public function allParameters(): array
    {
        $parts = $this->uriParts();

        $parameters = [];

        if (count($parts) > 2) {
            for ($i = 2; $i < count($parts); $i = $i + 2) {
                $parameters[$parts[$i]] = $parts[$i + 1] ?? null;
            }
        }

        return $parameters;
    }

    protected function uriParts(): array
    {
        $requestUri = $this->request->getServerValue('REQUEST_URI');

        $normalizedUri = $this->stripParametersFromUri($requestUri);

        $parts = explode('/', $normalizedUri);

        return array_filter($parts);
    }

    protected function stripParametersFromUri(string $uri): string
    {
        if ($strPos = strpos($uri, '?')) {
            return substr($uri, 0, $strPos);
        }
        return $uri;
    }
}