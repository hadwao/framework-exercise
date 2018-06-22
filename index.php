<?php
include 'vendor/autoload.php';
include 'app/config.php';

use Core\Request\HttpRequest;

session_start();

$request = new HttpRequest($_POST, $_GET, $_SERVER, $_SESSION);

$controllerClass = $request->getControllerClass();
$action = $request->getAction();

if (! class_exists($controllerClass)) {
    http_response_code(404);
    die();
}

$controller = new $controllerClass($request);
if (!method_exists($controller, $action))
{
    http_response_code(404);
    die();
}

echo $controller->$action();

