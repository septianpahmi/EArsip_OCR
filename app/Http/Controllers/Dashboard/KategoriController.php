<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $pageTitle = 'Kategori';
        $kategori = Categories::all();
        return view('admin.kategori.index', compact("pageTitle", "kategori"));
    }

    public function delete($id)
    {
        $kategori = Categories::find($id);
        $kategori->delete();
        return redirect()->route('kategori')->with('success', 'Kategori Berhasil Dihapus');
    }

    public function post(Request $request)
    {
        $cek = Categories::where('name', $request->name)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Kategori yang anda masukan sudah terdaftar');
        }
        $kategori = Categories::create([
            'name' => $request->name,
        ]);
        return redirect()->route('kategori')->with('success', 'Kategori Berhasil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $kategori = Categories::find($id);
        $kategori->name = $request->name;
        $kategori->save();
        return redirect()->route('kategori')->with('success', 'Kategori Berhasil Diubah');
    }
}
