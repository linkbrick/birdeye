<?php

namespace App\Http\ViewComposers;

use Bouncer;
use App\Entity;
use Illuminate\View\View;

class Navigation
{
    public function compose(View $view)
    {
        if(auth()->check())
            $view->with('companies',auth()->user()->companies);

        if(request()->tenant() != null)
        {
            $view->with('_entities', Entity::all());
            $view->with('_entity', Entity::find(session('entity', 0)));
        }
    }

}
