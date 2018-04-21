<?php

namespace App\Http\ViewComposers;

use Bouncer;
use Illuminate\View\View;

class Navigation
{
    public function compose(View $view)
    {
        if(auth()->check()) $view->with('companies',auth()->user()->companies);
    }

}