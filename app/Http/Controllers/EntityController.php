<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index()
    {
        $entities = Entity::all();
        return view('entities.index',compact('entities'));
    }

    public function create()
    {
        return view('entities.create');
    }

    public function store(Request $request)
    {
        // store the entity
        Entity::create($request->only(['name']));

        return redirect()->route('entities.index')->withSuccess('Entity has been created.');
    }

    public function switchEntity($id)
    {
        session()->put('entity',$id);
        return back();
    }
}
