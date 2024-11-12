<?php

namespace App\Controllers;

use Core\Database;
use Core\Validacao;
use App\Models\Usuario;

class LoginController
{
    public function index()
    {
        return view('login', template: 'guest');
    }

    public function login()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $validacao = Validacao::validar([
            'email' => ['required', 'email'],
            'senha' => ['required']
        ], $_POST);

        if ($validacao->naoPassou()) {
            return view('login', template: 'guest');
        }

        $database = new Database(config('database'));

        $usuario = $database->query(
            query: "select * from usuarios where email = :email",
            class: Usuario::class,
            params: compact('email')
        )->fetch();

        if (!($usuario && password_verify($senha, $usuario->senha))) {
            flash()->push('validacoes', ['email' => ['Usuário ou senha não incorretos!']]);

            return view('login', template: 'guest');
        }
        $_SESSION['auth'] = $usuario;
        flash()->push('mensagem', 'Seja bem Vindo ' . $usuario->nome . '!');
        return redirect('/dashboard');
    }
}
