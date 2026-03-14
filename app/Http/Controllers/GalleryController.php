<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_published', true)
            ->latest()
            ->get();

        return view('gallery.index', compact('galleries'));
    }
}
