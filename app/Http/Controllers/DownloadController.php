<?php

namespace App\Http\Controllers;

use App\Models\Download;

class DownloadController extends Controller
{
    public function index()
    {
        // Ambil semua file yang dipublish, kelompokkan per kategori
        $downloads = Download::where('is_published', true)
            ->orderBy('category')
            ->orderBy('title')
            ->get()
            ->groupBy('category');

        return view('downloads.index', compact('downloads'));
    }
}
