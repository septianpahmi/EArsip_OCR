<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Document;
use App\Models\Categories;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentDetailController extends Controller
{
    public function index($slug)
    {
        $katId = Categories::where('slug', $slug)->first();
        $pageTitle = $katId->name;
        $kategori = Categories::all();
        // dd($katId);
        $doc = Document::where('category_id', $katId->id)->get();
        $file = UploadFile::whereIn('document_id', $doc->pluck('id'))->whereHas('document', function ($query) {
            $query->where('status', 'active');
        })->with('document')->get();
        // if ($file->isEmpty()) {
        //     return redirect()->back()->with('error', 'Dokumen Tidak Ditemukan');
        // }
        return view('admin.dokumen.detail', compact('pageTitle', 'kategori', 'doc', 'file', 'katId'));
    }
}
