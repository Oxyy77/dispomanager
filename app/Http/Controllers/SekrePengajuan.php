<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class SekrePengajuan extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::paginate(10);
        return view('sekretaris.kelola', compact('pengajuan'));
    }
}
