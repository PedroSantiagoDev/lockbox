<?php

namespace App\Controllers\Notas;

class IndexController
{
    public function __invoke()
    {
        if (!auth()) {
            return redirect('/login');
        }

        return view('notas');
    }
}
