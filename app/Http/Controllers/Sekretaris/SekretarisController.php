<?php

namespace App\Http\Controllers\Sekretaris;
use App\Models\Surat;


use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SekretarisController extends Controller
{
    public function index(){
        $semuaSurat = Surat::latest()->take(5)->get();
        $pengajuan = Pengajuan::all()->count();
        $suratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->latest()->take(5)->get();
        $suratKeluar = Surat::where('jenis_surat', 'Surat Keluar')->latest()->take(5)->get();
        $jumlahSuratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->count();
        $jumlahSuratKeluar = Surat::where('jenis_surat', 'Surat Keluar')->count();
        return view('sekretaris.dashboard',compact('semuaSurat','suratMasuk','suratKeluar','jumlahSuratMasuk','jumlahSuratKeluar','pengajuan'));
    }

    public function suratMasuk() {
        $suratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->paginate(10);
        return view('sekretaris.surat-masuk',compact('suratMasuk'));
    }

    public function bacaSurat($id){
        $suratMasuk = Surat::findOrFail($id);
    
        if ($suratMasuk) {
            $suratMasuk->status_surat = 'Dibaca';
            $suratMasuk->save();
            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        }
    
        return redirect()->back()->with('error', 'Surat Masuk tidak ditemukan.');
    }

    public function semuaSurat(){
        $semuaSurat = Surat::paginate(10);
        $suratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->get();
        $suratKeluar = Surat::where('jenis_surat', 'Surat Keluar')->get();
        $jumlahSuratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->count();
        $pengajuan = Pengajuan::all()->count();
        

        return view('sekretaris.data',compact('semuaSurat','suratMasuk','suratKeluar','jumlahSuratMasuk','pengajuan'));
      
    }
}
