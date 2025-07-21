<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $pageTitle = 'Daftar Pengguna';
        $user = User::all();
        $kategori = Categories::all();
        return view('admin.users.index', compact("pageTitle", "user", "kategori"));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }

    public function post(Request $request)
    {
        $cek = User::where('email', $request->email)->exists();
        if ($cek) {
            return redirect()->back()->with('error', 'Email yang anda masukan sudah terdaftar');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->back()->with('success', 'Pengguna berhasil dibuat.');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $user->syncRoles($request->role);
        return redirect()->back()->with('success', 'Pengguna berhasil diubah.');
    }
}
