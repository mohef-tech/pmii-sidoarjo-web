<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');
Route::get('/artikel', [\App\Http\Controllers\PostController::class, 'articles'])->name('articles.index');
Route::get('/pengurus', [\App\Http\Controllers\PengurusController::class, 'index'])->name('pengurus.index');
Route::get('/pengajuan-sk', [\App\Http\Controllers\SkController::class, 'index'])->name('sk.index');
Route::post('/pengajuan-sk', [\App\Http\Controllers\SkController::class, 'store'])->name('sk.store');
Route::get('/download', [\App\Http\Controllers\DownloadController::class, 'index'])->name('downloads.index');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::get('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/e-magazine', [\App\Http\Controllers\EMagazineController::class, 'index'])->name('emagazine.index');
