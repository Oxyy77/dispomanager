<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Format;
use App\Models\Pengiriman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class SuratController extends Controller
{


    // Contoh pada SuratController
// app/Http/Controllers/FormatController.php

public function getFormatOptions(Request $request)
{
    function convertFormat($format)
    {
        // Ganti [bln] dengan bulan saat ini
        $currentMonth = date('m');
        $format = str_replace('[bln]', $currentMonth, $format);
    
        // Ganti [thn] dengan tahun saat ini
        $currentYear = date('y');
        $format = str_replace('[thn]', $currentYear, $format);
    
        return $format;
    }

    $kategori_surat = $request->input('kategori_surat');
    $formatOptions = Format::where('kategori_surat', $kategori_surat)->pluck('format_surat')->toArray();
    
    $optionsWithNumber = [];
    
    foreach ($formatOptions as $format) {
        // Cek apakah /[bln]/[thn] ada dalam format
        $includeMonthYear = strpos($format, '[bln]') !== false || strpos($format, '[thn]') !== false;
    
        $originalFormat = $includeMonthYear ? convertFormat($format) : $format;
    
        // Ambil nomor surat tertinggi dari database
        $lastNumberInDatabase = Surat::where('no_surat', 'like',  '%' . $originalFormat . '%')
            ->max('no_surat');
    
        // Debugging: Tampilkan nilai-nilai yang diperlukan
        \Illuminate\Support\Facades\Log::info([
            'originalFormat' => $originalFormat,
            'lastNumberInDatabase' => $lastNumberInDatabase,
        ]);
    
        if ($lastNumberInDatabase) {
            // Jika ada nomor surat, ambil angka pertama
            $lastNumber = intval(explode('/', $lastNumberInDatabase)[0]) + 1;
        } else {
            // Jika tidak ada nomor surat, set angka pertama menjadi 1
            $lastNumber = 1;
        }
    
        // Ganti /[bln]/[thn] dengan /m/y saat menampilkan nomor surat
        if ($includeMonthYear) {
            $currentMonthYear = date('m/y');
            $formatWithMonthYear = str_replace(['[bln]', '[thn]'], explode('/', $currentMonthYear), $format);
            $newNumber = $lastNumber . '/' . $formatWithMonthYear;
        } else {
            $newNumber = $lastNumber . '/' . $originalFormat;
        }
    
        // Debugging: Tampilkan nomor surat baru
        \Illuminate\Support\Facades\Log::info([
            'newNumber' => $newNumber,
        ]);
    
        $optionsWithNumber[] = $newNumber;
    }
    
    

    return response()->json($optionsWithNumber);
}






private function convertToRoman($number)
{
    $map = [
        'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII',
    ];

    return $map[$number - 1];
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
            // 'format_surat' => 'required|max:255',
            'nama_file' => 'required|mimes:pdf|max:2048',
        ]);

        // dd($request->all());

        $formatId = $request->input('no_surat');
      
        // Cek apakah terdapat bulan dan tahun pada format
        if (preg_match('/^\d+\/([^\/]+\/[^\/]+)\/\d+\/\d+$/', $formatId, $matches)) {
            // Format dengan PT/U (atau format serupa)
            $formatPart = $matches[1] . '/' . '[bln]' . '/' . '[thn]';
        }  elseif (preg_match('/^\d+\/(.+)$/', $formatId, $matches)) {
            // Format dengan apapun setelah digit pertama
            $formatPart = $matches[1];
        } else {
            // Format tidak sesuai
            dd('Format tidak sesuai');
        }
        
        
    

        // dd($formatPart);
        // Lakukan sesuatu dengan $formatPart (misalnya, tampilkan atau simpan ke variabel lain)

        // dd($formatIdWithoutNumber);
     
        $userFormats = Format::all();
        // dd($userFormats);
     
        $format = $userFormats->where('format_surat', $formatPart)->first();
        
       // Ambil semua format yang dimiliki oleh user

      
        // dd($format);

        $userId = auth()->user()->id;
        
        
        // Ambil format_id dari tabel pivot format_user
        $pivotData = DB::table('format_user')
    ->where('format_id', $format->id) // Pastikan menggunakan ID format dari $format
    ->first();
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

            $highestSuratId = Surat::max('id');

// Menentukan nilai surat_id untuk Pengiriman
            $suratIdForPengiriman = $highestSuratId;

            $pengirimanData = [
                'user_id' => auth()->user()->id,
                'surat_id' => $suratIdForPengiriman,
                'no_surat' => $validatedData['no_surat'],
                'nama_surat' => $validatedData['nama_surat'],
                'file_surat' => $validatedData['nama_file'],
                'jenis_surat' =>  $validatedData['jenis_surat'],// Sesuaikan dengan kolom yang sesuai di tabel pengiriman
                'status_pengiriman' => $validatedData['status_surat'], // Sesuaikan dengan nilai default yang sesuai di tabel pengiriman
            ];
            
            Pengiriman::create($pengirimanData);
            
            return redirect('/kelola-direktur')->with('success', 'Tambah Surat Berhasil Ditambahkan');
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

    public function bacaSurat($id)
    {
        // Mendapatkan informasi surat berdasarkan ID (misalnya menggunakan Eloquent)
        $surat = Surat::find($id);
    
        if (!$surat) {
            abort(404); // Sesuaikan dengan logika penanganan jika surat tidak ditemukan
        }
    
        // Mendapatkan URL file surat di dalam folder "storage"
        $url = asset("storage/surat masuk/{$surat->nama_file}");
        // dd($url);
        // Mengembalikan response file
        return view('direktur.baca-surat', ['url' => $url, 'surat' => $surat]);
    }
    

    public function tampilkanSurat($nama_file)
    {
        // Mendapatkan path file surat di dalam folder "storage"
        $path = storage_path("app/public/surat masuk/{$nama_file}");
        
        // Memeriksa apakah file surat ada
        if (file_exists($path)) {
            // Mengembalikan response file
            return response()->file($path);
        } else {
            abort(404); // Sesuaikan dengan logika penanganan jika file tidak ditemukan
        }
    }

    
}
