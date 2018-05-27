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

    }
}
