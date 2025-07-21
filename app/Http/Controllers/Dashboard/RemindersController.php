<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Document;
use App\Models\Reminder;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RemindersController extends Controller
{
    public function index()
    {
        $pageTitle = 'Pengingat';
        $reminders = Reminder::orderBy('remind_at', 'desc')->get();
        $dokumen = Document::all();
        $kategori = Categories::all();
        return view('admin.reminders.index', compact('pageTitle', 'reminders', 'dokumen', 'kategori'));
    }

    public function markRead($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->is_sent = true;
        $reminder->save();

        return redirect()->back()->with('success', 'Reminder telah ditandai sebagai dibaca.');
    }

    public function delete($id)
    {
        $reminder = Reminder::find($id);
        $reminder->delete();
        return redirect()->route('reminder')->with('success', 'Pengingat berhasil dihapus');
    }

    public function post(Request $request)
    {
        $reminder = new Reminder();
        $reminder->document_id = $request->document_id;
        $reminder->remind_at = Carbon::parse($request->remind_at)->format('Y-m-d H:i:s');
        $reminder->message = $request->message;
        $reminder->is_sent = false;
        $reminder->save();
        return redirect()->route('reminder')->with('success', 'Pengingat berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $reminder = Reminder::find($id);
        $reminder->document_id = $request->document_id;
        $reminder->remind_at = Carbon::parse($request->remind_at)->format('Y-m-d');
        $reminder->message = $request->message;
        $reminder->is_sent = false;
        $reminder->save();
        return redirect()->route('reminder')->with('success', 'Pengingat berhasil diubah');
    }
}
