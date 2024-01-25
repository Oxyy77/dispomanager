<?php

namespace App\Http\Controllers\Sekretaris;
use App\Http\Controllers\Controller;
use App\Models\Format;
use Illuminate\Http\Request;

class SekreFormatController extends Controller
{

 public function index(){
    $format = format::all();
    return view('sekretaris.format-surat', compact('format'));
 }



}
