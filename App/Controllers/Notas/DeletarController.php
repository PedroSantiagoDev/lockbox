<?php

namespace App\Controllers\Notas;

use App\Models\Nota;
use Core\Validacao;

class DeletarController
{
    public function __invoke()
    {
        $validacao = Validacao::validar([
            'id' => ['required'],
        ], request()->all());

        if ($validacao->naoPassou()) {
            return redirect('/notas?id='.request()->post('id'));
        }

        Nota::delete(request()->post('id'));

        flash()->push('mensagem', 'Nota deletado com sucesso!');

        return redirect('/notas');
    }
}
