@extends('layouts.main')
@section('extra-styles')
    <style>
        body {
            background-image: none;
            /* Menghapus background-image */
            background: #FFF;
        }
    </style>
@endsection
@section('container')
    <div class="row">
        <div class="col-md-2">
            @include('partials.sidebar')
        </div>
        <div style="padding:3rem!important;" class="col-md-10">
            <div style="margin: 0" class="row mb-4 dashboard-header">
                Kelola Surat
            </div>
            <div style="margin: 0" class="row mb-4 kelola-tambah">
                Tambah Surat
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="/tambah-surat/tambah" enctype="multipart/form-data">
                @csrf
        
                <label for="exampleFormControlInput1" class="form-label">Nama Surat</label>
                <input name="nama_surat" type="text" class="form-control mb-3" id="exampleFormControlInput1" placeholder="Masukkan Nama Surat">
                @error('nama_surat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        
                <label for="kategori-surat">Kategori Surat</label>
                <select name="kategori_surat" id="kategori_surat" class="form-select mb-3" aria-label="Default select example">
                    <option selected>Pilih No Surat</option>
                    @foreach($KategoriOptions as  $kategoriSurat)
                        <option value="{{ $kategoriSurat }}">{{ $kategoriSurat }}</option>
                    @endforeach 
                </select>
                @error('kategori_surat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        
                <label for="no-surat">No Surat</label>
                
                <select readonly name="no_surat" id="no_surat" class="form-select mb-3" aria-label="Default select example">
                    <option selected>Pilih No Surat</option>
                    @foreach($noSuratOptions as $id => $nomorSurat)
                        <option value="{{ $nomorSurat }}">{{ $nomorSurat }}</option>
                    @endforeach
                </select>
              
                @error('no_surat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        
                <label for="formFile" class="form-label">Upload Surat</label>
                <input name="nama_file" class="form-control mb-3" type="file" id="formFile">
                @error('nama_file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        
                <button type="submit" class="btn-first">Tambah</button>
            </form>
            </div>
        </div>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
   $(document).ready(function() {
    // Fungsi untuk menangani perubahan pada pilihan kategori surat
    $('#kategori_surat').on('change', function() {
        var selectedKategori = $(this).val();

        // Lakukan permintaan AJAX untuk mendapatkan data format surat dari server
        $.ajax({
            url: '/get-format-options', // Sesuaikan dengan route yang menangani permintaan
            method: 'POST',
            data: {
                kategori_surat: selectedKategori,
                _token: $('meta[name="csrf-token"]').attr('content'), // Pastikan token CSRF disertakan
            },
            dataType: 'json',
            success: function(response) {
                // Kosongkan opsi format surat saat ini
                $('#no_surat').empty();

                // Tambahkan opsi format surat yang baru berdasarkan data dari server
                $.each(response, function(index, value) {
                    $('#no_surat').append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan dalam mengambil data format surat: ' + error);
            }
        });
    });
});
</script>


@endsection
