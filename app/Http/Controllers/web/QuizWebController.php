<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class QuizWebController extends Controller
{
    public function index()
    {
        $quis = Quiz::all()->first();
        $soal = $quis->soal;
        
        

        return view('pageweb.quiz.index', compact('soal'));
    }

    
}