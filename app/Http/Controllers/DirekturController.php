<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DirekturController extends Controller
{
    public function index(){
        return view('direktur.dashboard');
    }
}
