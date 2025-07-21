<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Categories;
use App\Models\LogActivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function index()
    {
        $pageTitle = "Log Aktivitas";
        $audits = LogActivitas::all()->sortByDesc('created_at');
        $kategori = Categories::all();
        return view('admin.log.index', compact('pageTitle', 'audits', 'kategori'));
    }
}
