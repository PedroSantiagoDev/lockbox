<?php

use Core\Route;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\Notas\IndexController as IndexNotasController;
use App\Controllers\LogoutController;
use App\Controllers\Notas\CriarController;
use App\Controllers\RegisterController;
use App\Middleware\GuestMiddleware;
use App\Middleware\AuthMiddleware;

(new Route())
    ->get('/', IndexController::class, GuestMiddleware::class)

    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)

    ->get('/registrar', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/registrar', [RegisterController::class, 'register'], GuestMiddleware::class)

    ->get('/logout', LogoutController::class, AuthMiddleware::class)
    ->get('/notas', IndexNotasController::class, AuthMiddleware::class)
    ->get('/notas/criar', [CriarController::class, 'index'], AuthMiddleware::class)
    ->post('/notas/criar', [CriarController::class, 'store'], AuthMiddleware::class)
    ->run();


die();

$controller = str_replace('/', '', parse_url($_SERVER['REQUEST_URI'])['path']);

if (!$controller) $controller = 'index';

if (!file_exists("../controllers/{$controller}.controller.php")) {
    abort(404);
}

require "../controllers/{$controller}.controller.php";
