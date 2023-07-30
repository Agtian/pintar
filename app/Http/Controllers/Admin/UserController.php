<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('layouts.admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('layouts.admin.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required|string|min:8|confirmed',
            'role_as'   => 'required',
        ]);

        User::create([
            'name'      => $validatedData['name'],
            'email'     => $validatedData['email'],
            'password'  => Hash::make($validatedData['password']),
        ]);

        return redirect('dashboard/admin/user/create')->with('message', 'User added successfully.');
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('layouts.admin.user.edit', compact('user'));
    }

    public function update(Request $request, int $user_id)
    {
        $validatedData = $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required|confirmed',
            'role_as'   => 'required',
        ]);

        $user = User::findOrFail($user_id);
        $user->update([
            'name'      => $validatedData['name'],
            'email'     => $validatedData['email'],
            'password'  => $validatedData['password'],
            'role_as'   => $validatedData['role_as'],
        ]);

        return redirect('/dashboard/admin/user')->with('message', 'User updated successfully.');
    }

    public function destroy(int $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect()->back()->with('message', 'User deleted successfully.');
    }
}
