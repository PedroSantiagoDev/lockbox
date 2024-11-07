<?php

namespace App\Controllers;

class DashboardController
{
    public function __invoke()
    {
        return view('dashboard');
    }
}
