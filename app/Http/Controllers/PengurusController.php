<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;

class PengurusController extends Controller
{
    public function index()
    {
        $teams = Pengurus::where('is_active', true)
            ->orderBy('urutan')
            ->get();

        return view('pengurus.index', compact('teams'));
    }
}
