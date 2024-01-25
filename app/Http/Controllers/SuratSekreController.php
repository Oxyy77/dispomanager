<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Pengajuan;
use App\Models\Format;
use Illuminate\Support\Facades\DB;


class SuratSekreController extends Controller
{


public function getFormatOptions(Request $request)
{
    $kategori_surat = $request->input('kategori_surat');
    
    // Ambil data format surat dari database berdasarkan kategori surat
    $formatOptions = Format::where('kategori_surat', $kategori_surat)->pluck('format_surat')->toArray();

    // Tambahkan nomor otomatis ke setiap format surat
    $optionsWithNumber = [];
    foreach ($formatOptions as $format) {
        // Cari nomor terakhir yang ada di database
        $lastNumberInDatabase = Surat::where('no_surat', 'like', $format . '/%')->max('no_surat');

        // Jika nomor terakhir ada, ambil nomor berikutnya
        if ($lastNumberInDatabase) {
            $lastNumber = intval(substr($lastNumberInDatabase, strrpos($lastNumberInDatabase, '/') + 1));
            $lastNumber++;
        } else {
            // Jika tidak ada nomor sebelumnya, mulai dari 1
            $lastNumber = 1;
        }

        // Tambahkan nomor otomatis baru ke format surat
        $optionsWithNumber[] = $format . '/' . $lastNumber;
    }

    return response()->json($optionsWithNumber);
}





    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $noSuratOptions = Format::pluck('format_surat', 'id');
        $KategoriOptions = Format::pluck('kategori_surat', 'id');
        
        // Debugging: Cek nilai variabel sebelum dikirim ke view
    
        return view('sekretaris.tambah-surat', compact('noSuratOptions', 'KategoriOptions'));
    }
    
    

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_surat' => 'required|unique:surat',
            'kategori_surat' => 'required|max:255',
            'nama_surat' => 'required|max:255',
            'nama_file' => 'required|mimes:pdf|max:10240',
        ]);

        // dd($request->all());

        $formatId = $request->input('no_surat');
        $formatIdWithoutNumber = preg_replace('/\/\d+$/', '', $formatId);
     
        $userFormats = Format::all();
        // dd($userFormats);

     
        $format = $userFormats->where('format_surat', $formatIdWithoutNumber)->first();
        // dd($format);
     
      
    

        $userId = auth()->user()->id;
   
       
       
        // dd($userId);
        
        // Ambil format_id dari tabel pivot format_user
        $pivotData = DB::table('format_user')
    ->where('format_id', $format->id) // Pastikan menggunakan ID format dari $format
    ->first();

        if ($pivotData) {
            $formatId = $format->id;
  
            // Tambahkan format_id ke dalam data yang akan di-create
            $validatedData['format_id'] = $formatId;
            $validatedData['user_id'] = $userId;

            $uploadedFile = $request->file('nama_file');
        $fileName = $uploadedFile->storeAs('nama_file', $uploadedFile->getClientOriginalName(), 'public');

        // Set the file name in the validated data
        $validatedData['nama_file'] = $uploadedFile->getClientOriginalName();
        

        // Set the file name in the validated data
         $validatedData['nama_file'] = $fileName;
            $validatedData['jenis_surat'] = 'Surat Keluar';
            $validatedData['status_pengajuan'] = 'Perlu Tanda Tangan';
           
   
            Pengajuan::create($validatedData);
            return redirect('/dashboard/sekretaris')->with('success', 'Tambah Surat Berhasil Ditambahkan');
        } else {
            // Handle jika data tidak ditemukan
            return redirect('/dashboard/sekretaris')->with('error', 'Format_id tidak ditemukan');
        }
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
    public function destroy( $id)
    {
        try {
            DB::table('pengajuan')->where('id', $id)->delete();
           
            return redirect('/kelola-sekretaris')->with('success', 'Format Surat Berhasil Dihapus');
        } catch (\Exception $e) {
            // Menampilkan pesan kesalahan pada log atau mencetaknya untuk di-debug
           $e->getMessage();
           return redirect('/kelola-sekretaris');
        }
    }

    
}
