<?php

namespace Core;

use Core\Request;

class Route
{
    private static $request;

    public static function meth(string $path, $class, string $action)
    {
        $routes = new Request($path, $class, $action);

        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            self::$request['GET'][] = $routes;
            return $routes;
        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
            self::$request['POST'][] = $routes;
            return $routes;
        }
    }

    public static function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$request[$requestMethod] as $route) {
            if ($route->match($_SERVER['REQUEST_URI'])) {
                $route->execute();
                return;
            }
        }

        header('HTTP/1.0 404 Not Found');
    }
}