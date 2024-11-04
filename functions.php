<?php

function view($view, $data = [])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require "views/template/app.php";
}

function flash()
{
    return new Flash;
}

function config($chave = null)
{
    $config = require 'config.php';

    if (strlen($chave) > 0) {
        return $config[$chave];
    }

    return $config;
}

function dd(...$dump)
{
    dump($dump);
    die();
}

function dump(...$dump)
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
}

function abort($code)
{
    http_response_code($code);
    view($code);
    die();
}

function auth()
{
    if (!isset($_SESSION['auth'])) {
        return null;
    }

    return $_SESSION['auth'];
}

function old($campo)
{
    $post = $_POST;

    if (isset($post[$campo])) {
       return $post[$campo];
    }

    return '';
}
