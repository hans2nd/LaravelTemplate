<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data User',
            'menuAdminUser' => 'active',
            'users' => User::orderBy('jabatan', 'asc')->get(),   
        ];
        return view('admin/user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'menuAdminUser' => 'active',
        ];
        return view('admin/user/create', $data);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'jabatan' => 'required',
            'password' => 'required|min:6|confirmed',
        ],[
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jabatan.required' => 'Jabatan harus diisi',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Password Konfirmasi Tidak Sama',
            'password.min' => 'Password minimal 6 karakter',
        ]); 

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        $user->password = Hash::make($request->password);
        $user->is_tugas = false;
        $user->save();

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'menuAdminUser' => 'active',
            'user' => User::findOrFail($id),
        ];
        return view('admin/user/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'jabatan' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jabatan.required' => 'Jabatan harus diisi',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ],[
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 karakter',
                'password.confirmed' => 'Password Konfirmasi Tidak Sama',
            ]);

            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password);
            $user->save();
        }

        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;
        $user->save();

        return redirect()->route('user')->with('success', 'User berhasil diubah');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user')->with('success', 'User berhasil dihapus');
    }
}
