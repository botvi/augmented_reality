<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardAdminController extends Controller
{
 public function index(){
    return view('pageadmin.dashboard.index');
 }
}
