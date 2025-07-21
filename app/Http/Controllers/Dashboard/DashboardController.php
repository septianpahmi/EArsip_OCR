<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Document;
use App\Models\Categories;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Dashboard';
        $kategori = Categories::all();
        $katCount = Categories::count();
        $docCount = Document::count();
        $arsipCount = Document::where('status', 'archived')->count();
        $userCount = User::count();
        return view('admin.dashboard', compact('pageTitle', 'kategori', 'katCount', 'docCount', 'arsipCount', 'userCount'));
    }
    public function searchByTag(Request $request)
    {
        $query = $request->input('query');

        $results = UploadFile::whereHas('document.tags', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->with('document.tags')->get();

        return response()->json($results);
    }
}
