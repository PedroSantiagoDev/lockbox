<?php

namespace App\Controllers;

class DashboardController
{
    public function __invoke(): void
    {
        return view('dashboard');
    }
}
