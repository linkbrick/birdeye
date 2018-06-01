<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function sample()
    {
        return view('prototypes.dashboard');
    }
}
