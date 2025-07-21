<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Document;
use App\Models\Categories;
use App\Models\UploadFile;
use App\Models\DocumentTag;
use Illuminate\Support\Str;
use App\Models\DocumentType;
use App\Models\LogActivitas;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $pageTitle = 'Document';
        $document = UploadFile::all();
        $kategoriList = UploadFile::whereHas('document', function ($query) {
            $query->where('status', 'active');
        })->with('document')->get();
        $kategori = Categories::all();
        return view('admin.dokumen.index', compact("pageTitle", "document", "kategoriList", "kategori"));
    }
    public function documentCreate()
    {
        $pageTitle = 'Create Document';
        $categories = Categories::all();
        $tags = Tag::all();
        $kategori = Categories::all();
        return view('admin.dokumen.create', compact("pageTitle", "categories", "tags", "kategori"));
    }

    public function delete($id)
    {
        $uploadFile = UploadFile::findOrFail($id);
        $document = Document::where('id', $uploadFile->document_id)->first();

        if (Storage::exists($uploadFile->file_path)) {
            Storage::delete($uploadFile->file_path);
        }
        LogActivitas::create([
            'user_id' => Auth::id(),
            'document_id' => $document->id,
            'action' => 'Delete',
        ]);

        $uploadFile->delete();
        return redirect()->route('document')->with('success', 'Document berhasil dihapus.');
    }
    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'expired_at' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png,jpeg,',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $fileSize = $file->getSize();
        $filePath = $file->store('documents', 'public');

        $documentType = DocumentType::where('mime_type', $mimeType)->first();
        if (!$documentType) {
            $documentType = DocumentType::create([
                'name' => strtoupper($extension),
                'mime_type' => $mimeType,
            ]);
        }

        $document = Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'type_id' => $documentType->id,
            'user_id' => Auth::id(),
            'expired_at' => $request->expired_at ? Carbon::parse($request->expired_at)->format('Y-m-d') : null,
            'upload_at' => Carbon::now()->format('Y-m-d'),
            'status' => 'active',
        ]);

        UploadFile::create([
            'document_id' => $document->id,
            'file_path' => $filePath,
            'file_name' => $originalName,
            'extension' => $extension,
            'file_size' => $fileSize,
        ]);

        foreach ($request->tag_id as $tagId) {
            DocumentTag::create([
                'document_id' => $document->id,
                'tag_id' => $tagId,
            ]);
        }
        LogActivitas::create([
            'user_id' => Auth::id(),
            'document_id' => $document->id,
            'action' => 'Upload',
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function documentOcr()
    {
        $pageTitle = 'Dokumen OCR';
        $tags = Tag::all();
        $kategori = Categories::all();
        return view('admin.dokumen.ocr', compact("pageTitle", "tags", "kategori"));
    }

    public function documentOcrPost(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png,jpeg,',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $fileSize = $file->getSize();
        $filePath = $file->store('documents', 'public');

        $documentType = DocumentType::where('mime_type', $mimeType)->first();
        if (!$documentType) {
            $documentType = DocumentType::create([
                'name' => strtoupper($extension),
                'mime_type' => $mimeType,
            ]);
        }
        $parser = new Parser();
        $pdf = $parser->parseFile($file->getPathname());
        $text = strtolower($pdf->getText());

        if (Str::contains($text, ['surat keputusan', 'surat keputusan (sk)'])) {
            $typeGuess = 'Surat Keputusan (SK)';
        } elseif (Str::contains($text, ['surat edaran'])) {
            $typeGuess = 'Surat Edaran';
        } elseif (Str::contains($text, ['surat masuk', 'surat keluar'])) {
            $typeGuess = 'Surat Masuk/Keluar';
        } elseif (Str::contains($text, ['notulensi rapat'])) {
            $typeGuess = 'Notulensi Rapat';
        } elseif (Str::contains($text, ['laporan tahunan'])) {
            $typeGuess = 'Laporan Tahunan';
        } elseif (Str::contains($text, ['berita acara'])) {
            $typeGuess = 'Berita Acara';
        } elseif (Str::contains($text, ['dokumen akademik'])) {
            $typeGuess = 'Dokumen Akademik';
        } elseif (Str::contains($text, ['inventaris barang'])) {
            $typeGuess = 'Inventaris Barang';
        }

        if (!isset($typeGuess) || !$typeGuess) {
            $categoryId = Categories::where('name', 'Lainnya')->value('id');
        } else {
            $category = Categories::where('name', $typeGuess)->first();
            $categoryId = $category->id;
        }
        $document = Document::create([
            'title' => $originalName,
            'description' => null,
            'category_id' => $categoryId,
            'type_id' => $documentType->id,
            'user_id' => Auth::id(),
            'expired_at' => $request->expired_at ? Carbon::parse($request->expired_at)->format('Y-m-d') : null,
            'upload_at' => Carbon::now()->format('Y-m-d'),
            'status' => 'active',
        ]);

        UploadFile::create([
            'document_id' => $document->id,
            'file_path' => $filePath,
            'file_name' => $originalName,
            'extension' => $extension,
            'file_size' => $fileSize,
        ]);
        foreach ($request->tag_id as $tagId) {
            DocumentTag::create([
                'document_id' => $document->id,
                'tag_id' => $tagId,
            ]);
        }
        LogActivitas::create([
            'user_id' => Auth::id(),
            'document_id' => $document->id,
            'action' => 'Upload',
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function parsePdf(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Validasi: hanya file PDF
            if ($file->getClientOriginalExtension() !== 'pdf') {
                return response()->json(['error' => 'File harus berupa PDF.'], 422);
            }

            $parser = new Parser();
            $pdf = $parser->parseFile($file->getPathname());
            $text = $pdf->getText();

            return response()->json(['text' => $text]);
        }

        return response()->json(['error' => 'Tidak ada file yang dikirim.'], 400);
    }
    public function status($id)
    {
        $uploadFile = UploadFile::with('document')->where('id', $id)->firstOrFail();
        $uploadFile->document->status = 'archived';
        $uploadFile->document->save();
        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }
}
