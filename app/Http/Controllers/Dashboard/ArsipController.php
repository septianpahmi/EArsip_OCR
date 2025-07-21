<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Categories;
use App\Models\UploadFile;
use App\Models\LogActivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document as ModelsDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index()
    {
        $pageTitle = 'Arsip';
        $file = UploadFile::whereHas('document', function ($query) {
            $query->where('status', 'archived');
        })->with('document')->get();
        $list = Categories::where('name', '!=', 'Lainnya')->get();
        $kategori = Categories::all();
        return view('admin.arsip.index', compact("pageTitle", "file", "kategori", "list"));
    }


    public function delete($id)
    {
        $uploadFile = UploadFile::findOrFail($id);
        $document = ModelsDocument::where('id', $uploadFile->document_id)->first();

        if (Storage::exists($uploadFile->file_path)) {
            Storage::delete($uploadFile->file_path);
        }
        LogActivitas::create([
            'user_id' => Auth::id(),
            'document_id' => $document->id,
            'action' => 'Delete',
        ]);

        $uploadFile->delete();
        return redirect()->route('arsip')->with('success', 'Document berhasil dihapus.');
    }

    public function status($id)
    {
        $uploadFile = UploadFile::with('document')->where('id', $id)->firstOrFail();
        $uploadFile->document->status = 'active';
        $uploadFile->document->save();
        return redirect()->route('arsip')->with('success', 'Status berhasil diubah.');
    }
}
