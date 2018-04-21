<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Silber\Bouncer\Database\Ability;
use Bouncer;

class AbilityController extends Controller
{
    public function index()
    {
        $abilities = Ability::all();

        return view('abilities.index',compact('abilities'));
    }

    public function create()
    {
        return view('abilities.create');
    }

    public function store(Request $request)
    {
        $ok = Bouncer::ability()->create($request->only(['name', 'title']));

        if($ok){
            return redirect()->route('abilities.index')->withSuccess('New Ability has been created.');
        }else{
            return redirect()->route('abilities.create')->withError($ok);
        }
    }

    public function edit(Ability $ability)
    {
        return view('abilities.edit',compact('ability'));
    }

    public function update(Request $request, Ability $ability)
    {
        $ability->fill($request->only(['name', 'title']))->save();

        return redirect()->route('abilities.index')->withSuccess($request->input('name') . ' has been updated.');
    }


}
