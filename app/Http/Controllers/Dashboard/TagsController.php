<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Tags';
        $tags = Tag::all();
        $kategori = Categories::all();
        return view('admin.tags.index', compact('pageTitle', 'tags', 'kategori'));
    }

    public function delete($id)
    {
        $tags = Tag::find($id);
        $tags->delete();
        return redirect()->back()->with('success', 'Tags berhasil dihapus.');
    }

    public function post(Request $request)
    {
        $cek = Tag::where('name', $request->name)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Tags sudah ada.');
        }
        $tags = new Tag();
        $tags->name = $request->name;
        $tags->save();
        return redirect()->back()->with('success', 'Tags berhasil ditambahkan.');
    }

    public function edit(Request $request, $id)
    {
        $tags = Tag::find($id);
        $tags->name = $request->name;
        $tags->save();
        return redirect()->back()->with('success', 'Tags berhasil diubah.');
    }
}
