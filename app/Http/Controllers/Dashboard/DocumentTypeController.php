<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Categories;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Jenis Dokumen';
        $type = DocumentType::all();
        $kategori = Categories::all();
        return view('admin.documentype.index', compact("pageTitle", "type", "kategori"));
    }
}
