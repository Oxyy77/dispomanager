<?php

namespace App\Http\Controllers\Direktur;
use App\Http\Controllers\Controller;
use App\Models\Format;
use Illuminate\Http\Request;

class FormatSuratController extends Controller
{

 public function index(){
    $format = format::paginate(5);
    return view('direktur.format-surat', compact('format'));
 }



}
