<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Pengajuan;
use App\Models\Format;
use App\Models\Form;
use Illuminate\Support\Facades\DB;


class SuratSekreController extends Controller
{


    public function getFormatOptions(Request $request)
    {
        $kategori_surat = $request->input('kategori_surat');
        $formatOptions = Format::where('kategori_surat', $kategori_surat)->pluck('format_surat')->toArray();
        
        $optionsWithNumber = [];
        
        foreach ($formatOptions as $format) {
            // Cek apakah /[bln]/[thn] ada dalam format
            $includeMonthYear = preg_match('/\/\[bln\]\/\[thn\]/', $format);
    
            // Ambil nomor surat tertinggi dari database
            $lastNumberInDatabase = Surat::where('no_surat', 'like',  '%/' . $format)
                ->max('no_surat');
                
            if ($lastNumberInDatabase) {
                // Gunakan ekspresi reguler untuk mengambil angka pertama
                preg_match('/^\d+/', $lastNumberInDatabase, $matches);
                $lastNumber = intval($matches[0]) + 1;
            } else {
                // Jika tidak ada nomor surat, set angka pertama menjadi 1
                $lastNumber = 1;
            }
    
            // Ganti /[bln]/[thn] dengan /m/y saat menampilkan nomor surat
            if ($includeMonthYear) {
                $currentMonthYear = date('m/y');
                $formatWithMonthYear = str_replace('/[bln]/[thn]', '/' . $currentMonthYear, $format);
                $optionsWithNumber[] = $lastNumber . '/' . $formatWithMonthYear;
            } else {
                $optionsWithNumber[] = $lastNumber . '/' . $format;
            }
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

    public function buatSurat(){
        $noSuratOptions = Format::pluck('format_surat', 'id');
        $KategoriOptions = Format::pluck('kategori_surat', 'id');
        return view('sekretaris.tambah-surat2', compact('noSuratOptions','KategoriOptions'));
    }

    public function showForm($id){

        $form = form::find($id);
        
        $imagePath = public_path('img/' . $form->kop_surat);
$imagePathRelative = str_replace(public_path(), '', $imagePath);
$imagePathRelative = ltrim($imagePathRelative, '\\');
// dd($imagePathRelative);


        // dd($imagePath);
        return view('sekretaris.buat-surat', [
            'kopSurat' => $imagePathRelative,
            'tanggalSurat' => $form->tanggal_surat,
            'nomorSurat' => $form->no_surat,
            'hal' => $form->hal,
            'lampiran' => $form->lampiran,
            'tujuan' => $form->tujuan,
            'alamat' => $form->alamat,
            'salamPembuka' => $form->salam_pembuka,
            'isiSurat' => $form->isi_surat,
            'salamPenutup' => $form->salam_penutup,
            'ttdDirektur' => $form->ttd_direktur,
            'ttdSekretaris' => $form->ttd_sekretaris,
        ]);
    }
    
    public function makeForm(){
      
        $noSuratOptions = Format::pluck('format_surat');
        $KategoriOptions = Format::pluck('kategori_surat');
        
        return view('sekretaris.form-buat-surat',compact('noSuratOptions', 'KategoriOptions'));
    }
    public function makeForm2(){
        
        $salamPembuka = form::pluck('salam_pembuka')->first();
        return view('sekretaris.form-buat-surat2',compact('salamPembuka'));
    }
    public function makeForm3(){
        
        return view('sekretaris.form-buat-surat3');
    }

    public function makeForm4(){
        
        $salamPenutup = form::pluck('salam_penutup')->first();
        return view('sekretaris.form-buat-surat4',compact('salamPenutup'));
    }

    public function formSurat(Request $request){
        $validatedData = $request->validate([
            'hal' => 'required|max:255',
            'kategori_surat' => 'required',
            'no_surat' => 'required|max:255',
            'lampiran' => 'required|max:255', // Add this line for 'lampiran'
            'tujuan' => 'required|max:255',
            'alamat' => 'required|max:255',
        ]);

        // dd($validatedData);
        $form = Form::create($validatedData);

    // Menyimpan ID ke dalam sesi
         session(['form_id' => $form->id]); // Adjust the model name as needed
        return redirect('/sekretaris/form/buat-surat/step/2');
    
    }

    public function step2(Request $request) {
        // Validate the request if needed
        $request->validate([
            'salam_pembuka' => 'required',
        ]);
    
        // Mendapatkan ID dari sesi
        $formId = session('form_id');
    
        // Mengecek apakah ID ada dalam sesi
        if (!$formId) {
            return response()->json(['success' => false, 'message' => 'Form ID not found'], 404);
        }
    
        // Mendapatkan record Form berdasarkan ID
        $form = Form::find($formId);
    
        // Mengecek apakah record Form ditemukan
        if (!$form) {
            return response()->json(['success' => false, 'message' => 'Form not found'], 404);
        }
    
        // Memperbarui atribut salam_pembuka
        $form->salam_pembuka = $request->input('salam_pembuka');
    
        // Menyimpan perubahan ke database
        $form->save();
    
        return response()->json(['success' => true, 'message' => 'Data updated successfully']);
    }
    

    public function createStep3(Request $request) {
        $request->validate([
            'isi_surat' => 'required',
        ]);
    
        // Mendapatkan ID dari sesi
        $formId = session('form_id');
    
        // Mengecek apakah ID ada dalam sesi
        if (!$formId) {
            return response()->json(['success' => false, 'message' => 'Form ID not found'], 404);
        }
    
        // Mendapatkan record Form berdasarkan ID
        $form = Form::find($formId);
    
        // Mengecek apakah record Form ditemukan
        if (!$form) {
            return response()->json(['success' => false, 'message' => 'Form not found'], 404);
        }
    
        // Memperbarui atribut isi_surat
        $form->isi_surat = $request->input('isi_surat');
        $form->save();
    
        return response()->json(['success' => true, 'message' => 'Data updated successfully']);
    }
    
    
    public function step4(Request $request) {
        // Validate the request if needed
        $request->validate([
            'salam_penutup' => 'required', // Add any validation rules you need
        ]);
    
        // Mendapatkan ID dari sesi
        $formId = session('form_id');
    
        // Mengecek apakah ID ada dalam sesi
        if (!$formId) {
            return response()->json(['success' => false, 'message' => 'Form ID not found'], 404);
        }
    
        // Mendapatkan record Form berdasarkan ID
        $form = Form::find($formId);
    
        // Mengecek apakah record Form ditemukan
        if (!$form) {
            return response()->json(['success' => false, 'message' => 'Form not found'], 404);
        }
    
        // Memperbarui atribut salam_penutup
        $form->salam_penutup = $request->input('salam_penutup');
        $form->save();
    
        // Mendapatkan URL dengan ID yang sesuai
        $url = route('form-surat', ['id' => $form->id]);
    
        return response()->json(['success' => true, 'message' => 'Data updated successfully', 'url' => $url]);
    }
    
}
