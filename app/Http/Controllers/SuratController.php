<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Format;
use App\Models\Pengiriman;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{


    // Contoh pada SuratController
// app/Http/Controllers/FormatController.php

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
    
        return view('direktur.tambah-surat', compact('noSuratOptions', 'KategoriOptions'));
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
     
        $userFormats = Format::whereHas('users')->get();
       
     
        $format = $userFormats->where('format_surat', $formatIdWithoutNumber)->first();
       // Ambil semua format yang dimiliki oleh user
     
      
        // dd($format);

        $userId = auth()->user()->id;
        
        
        // Ambil format_id dari tabel pivot format_user
        $pivotData = DB::table('format_user')
        ->where([
            ['user_id', $userId]
        ])->first();
        // dd($pivotData);
        if ($pivotData) {
            $formatId = $format->id;
           
           
         
            // Tambahkan format_id ke dalam data yang akan di-create
            $validatedData['format_id'] = $formatId;
            $validatedData['user_id'] = $userId;
            $validatedData['status_surat'] = 'Menunggu Dikirim';

            $uploadedFile = $request->file('nama_file');
        $fileName = $uploadedFile->storeAs('nama_file', $uploadedFile->getClientOriginalName(), 'public');

        // Set the file name in the validated data
        $validatedData['nama_file'] = $uploadedFile->getClientOriginalName();
        

        // Set the file name in the validated data
          $validatedData['nama_file'] = $fileName;
          $validatedData['jenis_surat'] = 'Surat Keluar';
           
    // dd($validatedData);
            Surat::create($validatedData);

            $pengirimanData = [
                'user_id' => auth()->user()->id,
                'no_surat' => $validatedData['no_surat'],
                'nama_surat' => $validatedData['nama_surat'],
                'file_surat' => $validatedData['nama_file'],
                'jenis_surat' =>  $validatedData['jenis_surat'],// Sesuaikan dengan kolom yang sesuai di tabel pengiriman
                'status_pengiriman' => $validatedData['status_surat'], // Sesuaikan dengan nilai default yang sesuai di tabel pengiriman
            ];
            
            Pengiriman::create($pengirimanData);
            
            return redirect('/dashboard/direktur')->with('success', 'Tambah Surat Berhasil Ditambahkan');
        } else {
            // Handle jika data tidak ditemukan
            return redirect('/dashboard/direktur')->with('error', 'Format_id tidak ditemukan');
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
    public function destroy(string $id)
    {
        //
    }

    
}
