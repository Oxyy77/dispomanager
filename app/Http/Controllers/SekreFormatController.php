<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Surat;
use App\Models\Format;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;



class SekreFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $format = format::paginate(10);
        return view('sekretaris.format-surat', compact('format'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'kategori_surat' => 'required|max:255|unique:format',
                'format_surat' => 'required|unique:format',
            ]);
    
            // Mengambil nilai dari formulir
            $kategoriSurat = $request->input('kategori_surat');
            $formatSurat = $request->input('format_surat');
            $additionalInfo = $request->input('hidden_additional_info');
    
            // Menggabungkan nilai format_surat dengan additionalInfo
            $formatSuratWithAdditionalInfo = $formatSurat . $additionalInfo;
    
            // Menambahkan user_id berdasarkan pengguna yang saat ini terautentikasi
    
            // Tambahkan format ke basis data
            $format = Format::create([
                'kategori_surat' => $kategoriSurat,
                'format_surat' => $formatSuratWithAdditionalInfo,
            ]);
    
            $format->users()->attach(auth()->user()->id);
    
            return redirect('/sekretaris/format-surat')->with('success', 'Format Surat Berhasil Ditambahkan');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
    
            return back()
            ->with('error', implode('<br>', $errors))
            ->withInput();
        
        }
    }

    

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $format = Format::find($id);
        return view('sekretaris.edit', compact('format'));
            
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $rules = [
        'kategori_surat' => 'required|max:255',
    ];

    $existingFormat = Format::find($id);
    if ($existingFormat && $request->format_surat != $existingFormat->format_surat) {
        $rules['format_surat'] = 'required|unique:format';
    }

    $validatedData = $request->validate($rules);

    // Tidak perlu menambahkan user_id pada update
    Format::where('id', $id)->update($validatedData);
    return redirect('/sekretaris/format-surat')->with('success', 'Format Surat Berhasil DiEdit');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        // Surat::destroy($surat->id);
        // return redirect('/format-surat')->with('success', 'Format Surat Berhasil Dihapus');

        try {
            DB::table('format')->where('id', $id)->delete();
            return redirect('/sekretaris/format-surat')->with('success', 'Format Surat Berhasil Dihapus');
        } catch (\Exception $e) {
            // Menampilkan pesan kesalahan pada log atau mencetaknya untuk di-debug
           $e->getMessage();
           return redirect('/sekretaris/format-surat');
        }
        
    }
    
    
    

}