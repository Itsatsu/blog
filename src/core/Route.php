<?php

namespace Core;



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
        $session = new Session();

        if($session->getMessage() != null ){
            if($session->getMessage()['see'] == 0 ) {
                $session->seeMessage();
            }else{
                $session->deleteMessage();
            }
        }
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$request[$requestMethod] as $route) {

            if ($route->match($_SERVER['REQUEST_URI'])) {
                $route->execute();
                exit();
            }

        }

        header( 'Location: /404');
    }
}