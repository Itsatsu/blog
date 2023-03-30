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

    public function __Construct(string $path, $class, string $action)
    {
        $this->request = new HttpRequest();
        $this->path = trim($path, '/');
        $this->action = $action;
        $this->class = $class;

    }

    public function match($url)
    {

        $url = trim($url,'/');
        $path = preg_replace("#({[\w]+})#", "([^/]+)", $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $results)) {
            array_shift($results);
            $this->params = $results;

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
            return isset($this->params) ? $controller->$method(implode($this->params)) : $controller->$method();
        } else {
            return isset($this->params) ? $controller->$method($this->request, implode($this->params)) : $controller->$method($this->request);
        }
    }
}