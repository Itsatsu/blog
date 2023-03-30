<?php

namespace Core;

use Core\Request;

class Route
{
    private static $request;

    public static function meth(string $path, $class, string $action)
    {
        $routes = new Request($path, $class, $action);

        if(filter_input(INPUT_SERVER, 'REQUEST_METHOD'))
        {
            self::$request['GET'][] = $routes;
            return $routes;
        }else{
            self::$request['POST'][] = $routes;
            return $routes;
        }
    }


    public static function run()
    {
        foreach (self::$request[$_SERVER['REQUEST_METHOD']] as $route) {

            if ($route->match(filter_input(INPUT_GET,'url'))) {



                $route->execute();
                break;

            }else{
                header('HTTP/1.0 404 ');

            }
        }
    }
}