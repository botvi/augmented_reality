<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AugmentedReality;
use App\Models\Materi;

class KameraController extends Controller
{
    public function index()
    {
        $ar = AugmentedReality::first();
        if (!$ar) {
            return redirect()->back()->with('error', 'Tidak ada data AR yang tersedia');
        }

        $materi_ar = Materi::where('ar_id', $ar->id)->first();
        if (!$materi_ar) {
            return redirect()->back()->with('error', 'Tidak ada data materi yang tersedia');
        }

        return view('pageweb.kamera', compact('ar', 'materi_ar'));
    }
}