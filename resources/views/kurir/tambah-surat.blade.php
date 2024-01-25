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
            @include('partials.kurir.sidebar')
        </div>
        <div style="padding:3rem!important;" class="col-md-10">
            <div style="margin: 0" class="row mb-4 dashboard-header">
                Tambah Surat masuk
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <form method="post" action="/kurir/surat-masuk" enctype="multipart/form-data">
                    @csrf
                    <label for="exampleFormControlInput1" class="form-label">No Surat</label>
                    <input type="text"
                        class="form-control mb-3 @error('no_surat') is-invalid    
                    @enderror"
                        name="no_surat" id="exampleFormControlInput1" placeholder="Masukkaan Nomor Surat">
                    @error('no_surat')
                        <div style="font-weight:300" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="exampleFormControlInput1" class="form-label">Nama Surat</label>
                    <input type="text"
                        class="form-control mb-3 @error('nama_surat') is-invalid    
                    @enderror"
                        name="nama_surat" id="exampleFormControlInput1" placeholder="Masukkaan Format Surat">
                    @error('nama_surat')
                        <div style="font-weight:300" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="exampleFormControlInput2" class="form-label">File Surat</label>
                    <input type="File"
                        class="form-control mb-3 @error('file_surat') is-invalid    
                    @enderror"
                        name="file_surat" id="exampleFormControlInput2" >
                        @error('file_surat')
                        <div style="font-weight:300" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn-first">Tambah</button>
                </form>
               
            </div>
        </div>
    </div>
@endsection
