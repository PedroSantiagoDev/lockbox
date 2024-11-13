<?php

namespace App\Middleware;

class GuestMiddleware
{
    public function handle()
    {
        if (auth()) {
            return redirect('/notas');
        }
    }
}
