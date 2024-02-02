<?php

namespace App\Http\Controllers\Sekretaris;
use App\Models\Surat;


use App\Models\Pengajuan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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

    public function updateSekre($id)
{
    try {
        // Temukan surat berdasarkan ID
        $surat = Surat::with('pengiriman')->find($id);

        

        // Ubah status surat menjadi "Surat Diterima Sekretaris"
        $surat->update(['status_surat' => 'Surat Diterima Sekretaris']);

        // Juga, ubah status_pengiriman menjadi "Selesai" di Pengiriman
        $surat->pengiriman->update(['status_pengiriman' => 'Surat Diterima Sekretaris']);

        session([
            'surat_terima' => [
                'nama_surat' => $surat->nama_surat,
                'no_surat' => $surat->no_surat,
                'pengirim' => $surat->pengirim,
            ]
        ]);

        return redirect('/sekretaris/surat-masuk')->with('success', 'Surat Diterima oleh Sekretaris');
    } catch (\Exception $e) {
        return redirect('/sekretaris/surat-masuk')->with('error', 'Gagal memproses surat: ' . $e->getMessage());
    }
}

public function formkirimSurat(){
    // Mengakses nilai session yang telah disimpan
    $dataSurat = session('surat_terima');

    return view('sekretaris.kirim-surat', ['dataSurat' => $dataSurat]);
}

public function kirimSurat(Request $request)
{
    try {
        // Mendapatkan informasi surat dari sesi
        $dataSurat = session('surat_terima');
      
        // Validasi request
        $request->validate([
            'nama_file' => 'required|mimes:pdf,doc,docx,txt|max:2048', // Sesuaikan jenis file yang diizinkan dan maksimal ukuran
        ]);

        // Simpan file surat di direktori 'public/surat'
        $fileSurat = $request->file('nama_file');
        $namaFileSurat = $fileSurat->getClientOriginalName();
        $fileSurat->storeAs('public/surat masuk', $namaFileSurat);
// dd($fileSurat);
        // Update status surat pada tabel pengiriman
        $pengiriman = Pengiriman::where('nama_surat', $dataSurat['nama_surat'])
            ->where('no_surat', $dataSurat['no_surat'])
            ->where('pengirim', $dataSurat['pengirim'])
            ->first();

            $surat = Surat::where('nama_surat', $dataSurat['nama_surat'])
            ->where('no_surat', $dataSurat['no_surat'])
            ->where('pengirim', $dataSurat['pengirim'])
            ->first();
          
        if ($surat) {
            $surat->update([
                'nama_file' => $namaFileSurat,
                'status_surat' => 'Dikirim ke Direktur'
            ]);
        }

        if ($pengiriman) {
            $pengiriman->update([
                'status_pengiriman' => 'Dikirim ke Direktur',
            ]);
        }

        $pengiriman = Pengiriman::where('surat_id', $surat->id)->first();

        // Ubah status pengiriman menjadi "Surat Diterima Direktur"
        if ($pengiriman) {
            $pengiriman->update([
                'status_pengiriman' => 'Surat Diterima Direktur',
            ]);
        }

        // Update file surat pada tabel surat
       

        return redirect('/sekretaris/surat-masuk')->with('success', 'Surat berhasil dikirim ke Direktur');
    } catch (\Exception $e) {
        return redirect('/sekretaris/surat-masuk')->with('error', 'Gagal memproses surat: ' . $e->getMessage());
    }
}


}
