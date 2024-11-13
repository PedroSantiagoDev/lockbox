<?php

namespace Core;

class Route
{
    public $routes = [];

    private function addRoute($http, $uri, $controller, $middleware = null)
    {
        if (is_string($controller)) {
            $data = [
                'class' => $controller,
                'method' => '__invoke',
                'middleware' =>  $middleware
            ];
        }

        if (is_array($controller)) {
            $data = [
                'class' => $controller[0],
                'method' => $controller[1],
                'middleware' => $middleware
            ];
        }

        $this->routes[$http][$uri] = $data;
    }

    public function get($uri, $controller, $middleware = null)
    {
        $this->addRoute('GET', $uri, $controller, $middleware);

        return $this;
    }

    public function post($uri, $controller, $middleware = null)
    {
        $this->addRoute('POST', $uri, $controller, $middleware);

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
        $middleware = $routeInfo['middleware'];

        if ($middleware) {
            $m = new $middleware;
            $m->handle();
        }

        $c = new $class;
        $c->$method();
    }
}
