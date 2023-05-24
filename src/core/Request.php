<?php

namespace Core;
use Core\HttpRequest;


class Request
{
    private $path;
    private $action;
    private $class;
    private $params = [];
    private $request;
    private $data;

    public function __construct(string $path, string $class, string $action)
    {
        $this->request = new HttpRequest();
        $this->path = trim($path, '/');
        $this->action = $action;
        $this->class = $class;
    }

//    public function match($url)
//    {
//        $url = trim($url, '/');
//        $path = preg_replace("#({[\w]+})#", "([^/]+)", $this->path);
//
//        $pathToMatch = "#^$path$#";
//
//        if (preg_match($pathToMatch, $url, $results)) {
//
//            array_shift($results);
//            $this->params = $results;
//
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace("#({[\w]+})#", "([^/]+)", $this->path);

        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $matches)) {
            $params = [];

            preg_match_all("#{([\w]+)}#", $this->path, $paramNames);
            foreach ($paramNames[1] as $index => $paramName) {

                $params[$paramName] = $matches[$index + 1];
            }

            $this->params = $params;

            return true;
        } else {
            return false;
        }
    }

    public function execute()
    {
        $controller = $this->class;
        $controller = new $controller();

        $method = $this->action;
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return $controller->$method($this->params>0 ?? $this->params);

//            if (count($this->params) > 0) {
//                return $controller->$method($this->params);
//            } else {
//                return $controller->$method();
//            }

        } else {
                return $controller->$method($this->request, $this->params>0 ?? $this->params);

//            if (count($this->params) > 0) {
//                return $controller->$method($this->request, $this->params);
//            } else {
//                return $controller->$method($this->request);
//            }
        }
    }

    public function getParams()
    {
        return $this->params;
    }


}