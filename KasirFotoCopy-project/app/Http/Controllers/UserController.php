<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'shift' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'shift' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}