<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {

    public function index() {
        if(Auth::user()->role == 'Kasir') {
            $user = User::where('id', Auth::id())->get();
        } else {
            $user = User::orderByRaw("FIELD(role, 'Owner', 'Admin', 'Kasir')")->orderBy('nama_lengkap', 'asc')->get();
        }
        return view('user.index', compact('user'));
    }

    public function create() {
        if(Auth::user()->role == 'Kasir') return redirect('/user');
        return view('user.create');
    }

    public function store(Request $req) {
        if(Auth::user()->role == 'Kasir') return redirect('/user');
        
        if(Auth::user()->role == 'Admin' && $req->role == 'Owner') {
            return back()->with('error', 'Admin gabisa buat owner.');
        }

        $v = $req->validate(['username'=>'required|unique:user,username', 'password'=>'required', 'nama_lengkap'=>'required', 'alamat'=>'required', 'no_telp'=>'required', 'shift'=>'required', 'role'=>'required']);
        
        $v['password'] = bcrypt($v['password']);
        $v['status'] = 'Nonaktif';

        User::create($v);
        return redirect()->route('user.index')->with('success', 'User added.');
    }

    public function show(User $user) { 
        return view('user.show', compact('user')); 
    }

    public function edit(User $user) { 
        if(Auth::user()->role == 'Admin' && $user->role == 'Owner') {
            return back()->with('error', 'Akses Ditolak: Admin tidak bisa mengedit data Owner.');
        }
        return view('user.edit', compact('user')); 
    }

    public function update(Request $req, User $user) {
        if(Auth::user()->role == 'Admin' && $user->role == 'Owner') {
            return back()->with('error', 'Akses Ditolak: Admin tidak dapat mengupdate data Owner.');
        }

        $d = $req->validate(['username'=>'required', 'nama_lengkap'=>'required', 'alamat'=>'nullable', 'no_telp'=>'nullable', 'shift'=>'nullable', 'check_in'=>'nullable', 'check_out'=>'nullable', 'status'=>'required', 'foto'=>'nullable|image|mimes:jpeg,png,jpg|max:2048']);

        if($req->hasFile('foto')) {
            if($user->foto) Storage::delete('public/'.$user->foto);
            $d['foto'] = $req->file('foto')->store('uploads', 'public');
        }
        $user->update($d);
        return redirect()->route('user.index')->with('success', 'Update done.');
    }

    public function destroy(User $user) {
        if(Auth::user()->role == 'Owner' && $user->role == 'Owner') return back()->with('error', 'Gak bisa menghapus owner.');
        if(Auth::user()->role == 'Admin' && ($user->role == 'Owner' || $user->role == 'Admin')) return back()->with('error', 'Admin gabisa hapus admin/owner.');
        
        $user->delete();
        return back()->with('success', 'Deleted.');
    }

    public function resetPassword(Request $req, User $user) {
        if(Auth::user()->role == 'Kasir') return redirect('/user')->with('error', 'Forbidden.');
        
        if(Auth::user()->role == 'Admin' && $user->role == 'Owner') {
            return back()->with('error', 'Akses Ditolak: Admin tidak dapat mereset password Owner.');
        }

        $req->validate(['new_password'=>'required|min:3']);
        $user->password = bcrypt($req->new_password);
        $user->save();
        return back()->with('success', 'Password changed.');
    }

    public function cetakData(User $user) { return view('user.cetak', compact('user')); }

    public function updateStatus(Request $req, $id) {
        if(auth()->user()->role !== 'Owner') return redirect()->back()->with('error', 'Owner only.');
        $u = User::findOrFail($id);
        $u->status = $req->status;
        $u->save();
        return redirect()->back()->with('success', 'Status updated.');
    }
}