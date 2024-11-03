<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);

    if ($validacao->naoPassou('login')) {
        header('location: /login');
        exit();
    }

    $usuario = $database->query(
        query: 'select * from usuarios where email = :email',
        class: Usuario::class,
        params: compact('email')
    )->fetch();

    if ($usuario) {
        // Validar senha
        if (!password_verify($senha, $usuario->senha)) {
            flash()->push('validacoes_login', ['Usuário ou senha não incorretos!']);
            header('location: /login');
            exit();
        }

        $_SESSION['auth'] = $usuario;
        flash()->push('mensagem', 'Seja bem Vindo ' . $usuario->nome . '!');
        header('location: /');
        exit();
    }
}

view('login');
