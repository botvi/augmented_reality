<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

class WebMateriController extends Controller
{
    public function index()
    {
        $materi = Materi::all();
        return view('pageweb.materi.daftarmateri', compact('materi'));
    }
    public function detail($id)
    {
        $materi = Materi::find($id);
        return view('pageweb.materi.detailmateri', compact('materi'));
    }
}