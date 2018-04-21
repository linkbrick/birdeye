<?php

namespace App\Http\Controllers\People;

use App\Division;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Silber\Bouncer\Database\Role;
use Bouncer;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class UserController extends Controller
{
    public function index()
    {
        $users = User::active()->get();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $divisions = Division::all();
        return view('users.create',compact('roles','divisions'));
    }

    public function store(Request $request)
    {
        // store the corporates
        $user = User::create($request->only(['name', 'email']));

        $role = Role::find($request->input('role_id'));

        Bouncer::assign($role)->to($user);

        // send reset password email
        $credentials = ['email' => $request->input('email')];
        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject('NEW ACCESS To EMS SYSTEM');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->route('users.index')->withSuccess('User has been created and a password reset email has been sent to the user.');
            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }

    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->only(['name', 'email','status']))->save();

        $role = Role::find($request->input('role_id'));

        Bouncer::assign($role)->to($user);

        return redirect()->route('users.index')->withSuccess($request->input('name') . ' has been updated.');

    }
}
