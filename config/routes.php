<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\Notas\AtualizarController;
use App\Controllers\Notas\CriarController;
use App\Controllers\Notas\DeletarController;
use App\Controllers\Notas\IndexController as IndexNotasController;
use App\Controllers\Notas\VisualizarController;
use App\Controllers\RegisterController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Core\Route;

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
    ->put('/nota', AtualizarController::class, AuthMiddleware::class)
    ->delete('/nota', DeletarController::class, AuthMiddleware::class)

    ->get('/confirmar', [VisualizarController::class, 'confirmar'], AuthMiddleware::class)
    ->post('/mostrar', [VisualizarController::class, 'mostrar'], AuthMiddleware::class)
    ->get('/esconder', [VisualizarController::class, 'esconder'], AuthMiddleware::class)

    ->run();
