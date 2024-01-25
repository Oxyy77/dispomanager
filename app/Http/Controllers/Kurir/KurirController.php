<?php

namespace App\Http\Controllers\Kurir;
use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    public function index(){
        $pengiriman = Pengiriman::where('status_pengiriman', 'Menunggu Dikirim')->get()->count();
        $jumlahSuratMasuk = Pengiriman::where('jenis_surat', 'Surat Masuk')->get()->count();
        $jumlahSuratKeluar = Pengiriman::where('jenis_surat', 'Surat Keluar')->get()->count();
        $semuaSurat = Pengiriman::latest()->take(5)->get();
        $pengajuan = Pengiriman::all()->count();
        $suratMasuk = Pengiriman::where('jenis_surat', 'Surat Masuk')->latest()->take(5)->get();
        $suratKeluar = Pengiriman::where('jenis_surat', 'Surat Keluar')->latest()->take(5)->get();
        return view('kurir.dashboard' ,compact('pengiriman','jumlahSuratMasuk','jumlahSuratKeluar','semuaSurat','suratMasuk','suratKeluar'));
    }

    public function suratKeluar(){
        $suratKeluar = Pengiriman::where('jenis_surat', 'Surat Keluar')->paginate(10);

        return view('kurir.surat-keluar', compact('suratKeluar'));
    }

    public function semuaSurat(){

        $semuaSurat = Pengiriman::paginate(10);
        $suratMasuk = Pengiriman::where('jenis_surat', 'Surat Masuk')->get();
        $suratKeluar = Pengiriman::where('jenis_surat', 'Surat Keluar')->get();
        return view('kurir.data',compact('semuaSurat','suratMasuk','suratKeluar'));
    }
}
