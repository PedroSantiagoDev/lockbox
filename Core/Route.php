<?php

namespace Core;

class Route
{
    public $routes = [];

    private function addRoute($http, $uri, $controller)
    {
        if (is_string($controller)) {
            $data = [
                'class' => $controller,
                'method' => '__invoke'
            ];
        }

        if (is_array($controller)) {
            $data = [
                'class' => $controller[0],
                'method' => $controller[1]
            ];
        }

        $this->routes[$http][$uri] = $data;
    }

    public function get($uri, $controller)
    {
        $this->addRoute('GET', $uri, $controller);

        return $this;
    }

    public function post($uri, $controller)
    {
        $this->addRoute('POST', $uri, $controller);

        return $this;
    }

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $http = $_SERVER['REQUEST_METHOD'];

        if (! isset($this->routes[$http][$uri])) {
            abort(404);
        }

        $routeInfo = $this->routes[$http][$uri];

        $class = $routeInfo['class'];
        $method = $routeInfo['method'];

        $c = new $class;
        $c->$method();
    }
}
