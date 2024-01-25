<?php

namespace App\Http\Controllers\Direktur;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Pengiriman;
use App\Models\Surat;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DirekturController extends Controller
{
    public function index(){
        $semuaSurat = Surat::latest()->take(5)->get();
        $suratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->latest()->take(5)->get();
        $suratKeluar = Surat::where('jenis_surat', 'Surat Keluar')->latest()->take(5)->get();
        $jumlahSuratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->count();
        $jumlahSuratKeluar = Surat::where('jenis_surat', 'Surat Keluar')->count();
        $pengajuan = Pengajuan::all()->count();
        

        return view('direktur.dashboard',compact('semuaSurat','suratMasuk','suratKeluar','jumlahSuratMasuk','jumlahSuratKeluar','pengajuan'));
      
    }

    public function kelola(){
        $pengajuan = Pengajuan::paginate(10);
        return view('direktur.kelola',compact('pengajuan'));
    }

    public function edit($id){
        $surat = Pengajuan::findOrFail($id);
        $surat->status_pengajuan = 'Sudah Ditandatangani';
        $surat->save();
        
        Surat::create([
            'user_id' => $surat->user_id,
            'format_id' => $surat->format_id,
            'no_surat' => $surat->no_surat,
            'kategori_surat' => $surat->kategori_surat,
            'nama_surat' => $surat->nama_surat,
            'jenis_surat' => $surat->jenis_surat,
            'status_surat' => 'Menunggu Dikirim',
            'nama_file' => $surat->nama_file,
            
        ]);

        Pengiriman::create([
            'user_id' => $surat->user_id,
            'no_surat' => $surat->no_surat,
            'nama_surat' => $surat->nama_surat,
            'jenis_surat' => $surat->jenis_surat,
            'status_pengiriman' => 'Menunggu Dikirim',
            'file_surat' => $surat->nama_file,
            
        ]);

        $surat->delete();
        
        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function suratMasuk() {
        $suratMasuk = Surat::where('jenis_surat', 'Surat Masuk')->paginate(10);
        return view('direktur.surat-masuk',compact('suratMasuk'));
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
        

        return view('direktur.data',compact('semuaSurat','suratMasuk','suratKeluar','jumlahSuratMasuk','pengajuan'));
      
    }
    
}
