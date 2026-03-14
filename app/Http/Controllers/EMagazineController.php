<?php

namespace App\Http\Controllers;

use App\Models\EMagazine;

class EMagazineController extends Controller
{
    public function index()
    {
        $magazines = EMagazine::where('is_published', true)
            ->latest()
            ->get();

        return view('emagazine.index', compact('magazines'));
    }
}
