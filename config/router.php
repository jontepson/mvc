<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? new RouteCollector(
    new \FastRoute\RouteParser\Std(),
    new \FastRoute\DataGenerator\MarkBased()
);

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\jope\Controller\Index");
$router->addRoute("GET", "/debug", "\jope\Controller\Debug");
$router->addRoute("GET", "/twig", "\jope\Controller\TwigView");

$router->addGroup("/dice", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\jope\Controller\DiceController", "start"]);
    $router->addRoute("POST", "", ["\jope\Controller\DiceController", "play"]);
});

$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\jope\Controller\yatzyController", "start"]);
    $router->addRoute("POST", "", ["\jope\Controller\yatzyController", "play"]);
});

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\jope\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\jope\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\jope\Controller\Sample", "where"]);
});