<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle()
    {
        if (! auth()) {
            return redirect('/login');
        }
    }
}
