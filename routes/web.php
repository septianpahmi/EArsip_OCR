<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\LogController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\Dashboard\ArsipController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\DocumentController;
use App\Http\Controllers\Dashboard\KategoriController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DocumentDetailController;
use App\Http\Controllers\Dashboard\RemindersController;
use App\Http\Controllers\Dashboard\DocumentTypeController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/search-tags', [DashboardController::class, 'searchByTag'])->middleware(['auth', 'verified'])->name('search.tags');
Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    //manage-users
    Route::get('/dashboard/users', [UsersController::class, 'index'])->name('users');
    Route::get('/dashboard/users/{id}', [UsersController::class, 'delete'])->name('users.delete');
    Route::post('/dashboard/users/post', [UsersController::class, 'post'])->name('users.post');
    Route::post('/dashboard/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    //kategori
    Route::get('/dashboard/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/dashboard/kategori/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');
    Route::post('/dashboard/kategori/post', [KategoriController::class, 'post'])->name('kategori.post');
    Route::post('/dashboard/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    //jenis-dokument
    Route::get('/dashboard/documenType', [DocumentTypeController::class, 'index'])->name('documenType');
    Route::get('/dashboard/documenType/{id}', [DocumentTypeController::class, 'delete'])->name('documenType.delete');
    Route::post('/dashboard/documenType/post', [DocumentTypeController::class, 'post'])->name('documenType.post');
    Route::post('/dashboard/documenType/edit/{id}', [DocumentTypeController::class, 'edit'])->name('documenType.edit');
    //Tags
    Route::get('/dashboard/tag', [TagsController::class, 'index'])->name('tag');
    Route::get('/dashboard/tag/{id}', [TagsController::class, 'delete'])->name('tag.delete');
    Route::post('/dashboard/tag/post', [TagsController::class, 'post'])->name('tag.post');
    Route::post('/dashboard/tag/edit/{id}', [TagsController::class, 'edit'])->name('tag.edit');
    //audit
    Route::get('/dashboard/audit', [LogController::class, 'index'])->name('audit');
});

Route::group(['middleware' => ['auth', 'role:Tata Usaha']], function () {
    //upload-document
    Route::get('/dashboard/document', [DocumentController::class, 'index'])->name('document');
    Route::get('/dashboard/document/{id}', [DocumentController::class, 'delete'])->name('document.delete');
    Route::get('/dashboard/document-create', [DocumentController::class, 'documentCreate'])->name('document.create');
    Route::post('/dashboard/document/post', [DocumentController::class, 'post'])->name('document.post');
    Route::get('/dashboard/ocr', [DocumentController::class, 'documentOcr'])->name('document.ocr');
    Route::post('/dashboard/ocr/post', [DocumentController::class, 'documentOcrPost'])->name('documentOcr.post');
    Route::get('/dashboard/document/status/{id}', [DocumentController::class, 'status'])->name('document.status');
    Route::post('/parse-pdf', [DocumentController::class, 'parsePdf'])->name('pdf.parse');
    //dokumen-detail
    Route::get('/dashboard/document-kat/{slug}', [DocumentDetailController::class, 'index'])->name('document.detail');
    //arsip
    Route::get('/dashboard/arsip', [ArsipController::class, 'index'])->name('arsip');
    Route::get('/dashboard/arsip/{id}', [ArsipController::class, 'delete'])->name('arsip.delete');
    Route::get('/dashboard/arsip/status/{id}', [ArsipController::class, 'status'])->name('arsip.status');
    //reminder
    Route::get('/dashboard/reminder', [RemindersController::class, 'index'])->name('reminder');
    Route::get('/reminders/mark-read/{id}', [RemindersController::class, 'markRead'])->name('reminder.read');
    Route::get('/dashboard/reminder/{id}', [RemindersController::class, 'delete'])->name('reminder.delete');
    Route::post('/dashboard/reminder/post', [RemindersController::class, 'post'])->name('reminder.post');
    Route::post('/dashboard/reminder/edit/{id}', [RemindersController::class, 'edit'])->name('reminder.edit');
});
require __DIR__ . '/auth.php';
