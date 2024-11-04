<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);

    if ($validacao->naoPassou()) {
        view('login');
        exit();
    }

    $usuario = $database->query(
        query: 'select * from usuarios where email = :email',
        class: Usuario::class,
        params: compact('email')
    )->fetch();

    if ($usuario && password_verify($senha, $usuario->senha)) {
        $_SESSION['auth'] = $usuario;

        flash()->push('mensagem', 'Seja bem Vindo ' . $usuario->nome . '!');
        header('location: /');
        exit();
    } else {
        flash()->push('validacoes', ['email' => ['Usuário ou senha não incorretos!']]);
    }
}

view('login');
