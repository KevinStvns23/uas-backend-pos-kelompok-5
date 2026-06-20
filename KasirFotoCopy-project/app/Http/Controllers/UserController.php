<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderByRaw("FIELD(role, 'Owner', 'Admin', 'Kasir')")
                    ->orderBy('nama_lengkap', 'asc')
                    ->get();

        return view('user.index', compact('user'));
    }

    public function create()
    {
        if (Auth::user()->role != 'Owner' && Auth::user()->role != 'Admin') {
            return redirect('/user'); 
        }

        return view('user.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'Owner' && Auth::user()->role != 'Admin') {
            return redirect('/user');
        }

        $validated = $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'shift' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
            'role' => 'required',
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
        'alamat' => 'nullable',
        'no_telp' => 'nullable',
        'shift' => 'nullable',
        'check_in' => 'nullable',
        'check_out' => 'nullable',
        'status' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
    ]);

    if ($request->hasFile('foto')) {
        if ($user->foto) {
            Storage::delete('public/' . $user->foto);
        }
        
        $path = $request->file('foto')->store('uploads', 'public');
        $validated['foto'] = $path;
    }

    
    $user->update($validated);

    return redirect()->route('user.index')->with('success', 'Data berhasil diupdate!');
}

    public function destroy(User $user)
    {
        if (Auth::user()->role == 'Admin' && ($user->role == 'Owner' || $user->role == 'Admin')) {
            return redirect('/user')->with('error', 'Akses ditolak.');
        }

        $user->delete();

        return redirect()->route('user.index');
    }

    public function resetPassword(User $user)
    {
        if (Auth::user()->role == 'Kasir') {
            return redirect('/user')->with('error', 'Akses ditolak.');
        }

        $user->password = bcrypt('12345');
        $user->save();

        return back()->with('success', 'Password berhasil direset ke 12345');
    }

    public function cetakData(User $user)
    {
       
    return view('user.cetak', compact('user'));

    }

    public function updateStatus(Request $request, $id)
{
    if (auth()->user()->role !== 'Owner') {
        return redirect()->back()->with('error', 'Hanya Owner yang bisa mengubah status!');
    }

    $user = \App\Models\User::findOrFail($id);
    $user->status = $request->status;
    $user->save();

    return redirect()->back()->with('success', 'Status berhasil diubah menjadi ' . $request->status);
}
}