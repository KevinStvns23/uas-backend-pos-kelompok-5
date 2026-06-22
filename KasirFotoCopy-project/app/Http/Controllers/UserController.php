<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function index() {
        if(Auth::user()->role == 'Kasir') {
            $user = User::where('id', Auth::id())->get();
        } else {
            $user = User::orderByRaw("FIELD(role, 'Owner', 'Admin', 'Kasir')")->orderBy('nama_lengkap', 'asc')->get();
        }
        return view('user.index', compact('user'));
    }

    public function show(User $user) {
    return view('user.show', compact('user'));
}
    public function create() {
        return view('user.create');
    }

    public function store(Request $req) {
        $v = $req->validate([
            'username' => 'required|unique:user,username', 
            'password' => 'required', 
            'nama_lengkap' => 'required', 
            'alamat' => 'required', 
            'no_telp' => 'required', 
            'shift' => 'required', 
            'role' => 'required'
        ]);
        
        $v['password'] = bcrypt($v['password']);
        $v['status'] = 'Nonaktif';

        User::create($v);
        return redirect()->route('user.index');
    }

    public function edit(User $user) { 
        return view('user.edit', compact('user')); 
    }

    public function update(Request $req, User $user) {
        $d = $req->validate([
            'username' => 'required', 
            'nama_lengkap' => 'required', 
            'alamat' => 'nullable', 
            'no_telp' => 'nullable', 
            'shift' => 'required', 
            'role' => 'required',
            'status' => 'required'
        ]);

        if ($req->filled('password')) {
            $d['password'] = bcrypt($req->password);
        }

        $user->update($d);
        return redirect()->route('user.index');
    }

    public function updateStatus(Request $req, $id) {
        $u = User::findOrFail($id);
        $u->status = $req->status;
        $u->save();
        return back();
    }

    public function destroy(User $user) {
        $user->delete();
        return back();
    }

    public function resetPassword(User $user) {
        $user->password = bcrypt('12345');
        $user->save();
        return back();
    }
}