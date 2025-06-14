<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AugmentedReality;
use App\Models\Materi;

class KameraController extends Controller
{
    public function index()
    {
        $ar_list = AugmentedReality::with('materi')->get();
        
        if ($ar_list->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada data AR yang tersedia'
            ]);
        }

        return view('pageweb.kamera', compact('ar_list'));
    }
}