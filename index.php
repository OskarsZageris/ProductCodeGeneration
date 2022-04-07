<?php

require_once 'vendor/autoload.php';

use Twig\Environment as Environment;
use Twig\Loader\FilesystemLoader as FilesystemLoader;
use App\View;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\ProductsController', 'index']);
    $r->addRoute('POST', '/select', ['App\Controllers\ProductsController', 'selected']);
    $r->addRoute('POST', '/code', ['App\Controllers\ProductsController', 'code']);
});
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump("404 not found");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump("405 Method Not Allowed");
        break;
    case FastRoute\Dispatcher::FOUND:
        $vars = $routeInfo[2];
        $route = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        /* @var View $response */
        $response = (new $route)->$method($vars);
        $loader = new FilesystemLoader('app/Views');
        $twig = new Environment($loader);
        if ($response instanceof View) {
            echo $twig->render($response->getPath(), $response->getVariables());
        }
        if ($response instanceof \app\Redirect) {
            header("Location: " . $response->getLocation());
            exit;
        }
        break;
}
