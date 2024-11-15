<?php

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{
    public function __invoke()
    {
        $pesquisar = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : null;

        $notas = Nota::all(filter: $pesquisar);

        $id = isset($_GET['id']) ? $_GET['id'] :($notas[0]->id ?? null);

        $filtro = array_filter($notas, fn ($n) => $n->id == $id);
        $notaSelecionada = array_pop($filtro);

        if (!$notaSelecionada) {
            return view('notas/nao-encontrado');
        }

        return view('notas', [
            'notas' => $notas,
            'notaSelecionada' => $notaSelecionada
        ]);
    }
}
