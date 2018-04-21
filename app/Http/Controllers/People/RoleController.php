<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Silber\Bouncer\Database\Ability;
use Silber\Bouncer\Database\Role;
use Bouncer;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $abilities = Ability::all();

        return view('roles.create',compact('abilities'));
    }

    public function store(Request $request)
    {
        $role = Bouncer::role()->create($request->only(['name','title']));

        if($request->filled('abilities')) {
            Bouncer::sync($role)->abilities($request->input('abilities'));
        }

        return redirect()->route('roles.index')->withSuccess('New role has been created.');
    }

    public function edit(Role $role)
    {
        $abilities = Ability::all();

        return view('roles.edit',compact('role','abilities'));
    }

    public function update(Request $request, Role $role)
    {
        $role->fill($request->only(['name','title']))->save();

        if($request->filled('abilities')) {
            Bouncer::sync($role)->abilities($request->input('abilities'));
        }

        return redirect()->route('roles.index')->withSuccess($request->input('name') . ' has been updated.');

    }
}
