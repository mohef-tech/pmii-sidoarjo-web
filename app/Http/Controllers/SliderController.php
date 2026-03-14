<?php

namespace App\Http\Controllers;

use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
            ->orderBy('urutan')
            ->get();

        return view('slider.index', compact('sliders'));
    }
}
