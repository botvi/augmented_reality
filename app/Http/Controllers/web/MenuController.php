<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return view('pageweb.menu');
    }
}