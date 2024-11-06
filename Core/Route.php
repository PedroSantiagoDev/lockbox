<?php

namespace Core;

class Route
{
    public $routes = [];

    public function get($uri, $controller)
    {
        dd($uri, $controller);
        return $this;
    }

    public function post()
    {
        return $this;
    }

    public function run() {}
}
