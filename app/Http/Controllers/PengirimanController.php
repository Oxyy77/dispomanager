<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pengiriman;
use App\Models\Surat;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengiriman = Pengiriman::where('jenis_surat', 'Surat Masuk')->paginate(10);
        return view('kurir.surat-masuk', compact('pengiriman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('kurir.tambah-surat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'no_surat' => 'required|max:255',
            'nama_surat' => 'required|max:255',
            'file_surat' => 'required|mimes:pdf|max:10240',
        ]);
        
        $user_id = auth()->id();
        $validatedData['user_id'] = $user_id;
        // Menambahkan user_id berdasarkan pengguna yang saat ini terautentikasi
        $uploadedFile = $request->file('file_surat');
        $fileName = $uploadedFile->storeAs('surat masuk', $uploadedFile->getClientOriginalName(), 'public');
        $validatedData['status_pengiriman'] = 'Menunggu Dikirim';
        $validatedData['file_surat'] = $fileName;
        $validatedData['jenis_surat'] = 'Surat Masuk';
      
        // Tambahkan format ke basis data
        Pengiriman::create($validatedData);
    
        return redirect('/kurir/surat-masuk')->with('success', 'Format Surat Berhasil Ditambahkan');
    }

    public function kirim(string $id)
{
    $pengiriman = Pengiriman::findOrFail($id);



    if ($pengiriman->status_pengiriman != 'Selesai') {
        $pengiriman->update(['status_pengiriman' => 'Dalam Pengiriman']);
        return redirect('/kurir/surat-masuk')->with('success', 'Surat berhasil dikirim.');
    }

    

    return redirect('/kurir/surat-masuk')->with('error', 'Surat sudah selesai, tidak dapat dikirim lagi.');
}

public function selesai(string $id)
{
    $pengiriman = Pengiriman::findOrFail($id);

    if ($pengiriman->status_pengiriman != 'Selesai') {
        $pengiriman->update(['status_pengiriman' => 'Selesai']);
        Surat::create([
            'user_id' => $pengiriman->user_id,
            'no_surat' => $pengiriman->no_surat,
            'nama_surat' => $pengiriman->nama_surat,
            'jenis_surat' => $pengiriman->jenis_surat,
            'nama_file' => $pengiriman->file_surat
        ]);
        return redirect('/kurir/surat-masuk')->with('success', 'Surat berhasil diselesaikan.');
    }

    

    return redirect('/kurir/surat-masuk')->with('error', 'Surat sudah selesai, tidak dapat diselesaikan lagi.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function keluarKirim(string $id)
{
    $pengiriman = Pengiriman::findOrFail($id);

    if ($pengiriman->status_pengiriman != 'Selesai') {
        // Update status_pengiriman di tabel pengiriman
        $pengiriman->update(['status_pengiriman' => 'Dalam Pengiriman']);

        // Update status_pengiriman di tabel surat
        $surat = Surat::where('no_surat', $pengiriman->no_surat)->first();
       
        if ($surat) {
            $surat->update(['status_surat' => 'Dalam Pengiriman']);
        }
    

        // Tambahan logika lain yang mungkin diperlukan
        return redirect('/kurir/surat-keluar')->with('success', 'Surat berhasil dikirim.');
    }

    return redirect('/kurir/surat-keluar')->with('error', 'Surat sudah selesai, tidak dapat dikirim lagi.');
}

public function keluarSelesai(string $id)
{
    $pengiriman = Pengiriman::findOrFail($id);

    // Update status_pengiriman di tabel pengiriman
    $pengiriman->update(['status_pengiriman' => 'Selesai']);

    // Update status_pengiriman di tabel surat
    $surat = Surat::where('no_surat', $pengiriman->no_surat)->first();
    if ($surat) {
        $surat->update(['status_surat' => 'Selesai']);
    }
    

    // Tambahan logika lain yang mungkin diperlukan
    return redirect('/kurir/surat-keluar')->with('success', 'Surat selesai.');
}

}
