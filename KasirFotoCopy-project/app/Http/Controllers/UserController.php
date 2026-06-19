<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        // Gembok: Hanya Owner dan Admin yang bisa melihat halaman tambah user
        if (auth()->user()->role != 'Owner' && auth()->user()->role != 'Admin') {
            return redirect('/user'); 
        }

        return view('user.create');
    }

    public function store(Request $request)
    {
        // Gembok lapis kedua saat menyimpan data
        if (auth()->user()->role != 'Owner' && auth()->user()->role != 'Admin') {
            return redirect('/user');
        }

        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'shift' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
            'role' => 'required', // Tambahan validasi wajib isi role
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'shift' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
        ]);

        $user->update($validated);

        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }
}