<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 24.06.18
 * Time: 12:15
 */

namespace Core;

use Core\Request\HttpRequest;
use DI\Annotation\Inject;

class Router
{
    /**
     * @var HttpRequest
     * @Inject
     */
    private $request;

    /**
     * @return string
     */
    public function getController(): string
    {
        return 'Controller\\' . ucfirst($this->getControllerName()) . 'Controller';
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->getActionName() . 'Action';
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        $uriParts = $this->getUriParts();
        return $uriParts[0] ?? APP_DEFAULT_CONTROLLER;
    }


    /**
     * @return string
     */
    public function getActionName(): string
    {
        $uriParts = $this->getUriParts();
        return $uriParts[1] ?? APP_DEFAULT_ACTION;
    }

    /**
     * @return array
     */
    protected function getUriParts(): array
    {
        $parts = explode('/', $this->request->getServerValue('REQUEST_URI'));
        return array_values(array_filter($parts));
    }

    /**
     * @return array
     */
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

    /**
     * @param $name
     * @param null $default
     * @return string
     */
    public function getParameter($name, $default = null): string
    {
        return $this->getParameters()[$name] ?? $default;
    }
}