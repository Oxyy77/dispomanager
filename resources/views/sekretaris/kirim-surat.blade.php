
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
@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: '{!! session('error') !!}',
                });
        });
    </script>
    @endif
    <div class="row">
        <div class="col-md-2">
            @include('partials.sekretaris.sidebar')
        </div>
        <div style="padding:3rem!important;" class="col-md-10">
            <div style="margin: 0" class="row mb-4 dashboard-header">
                Kirim Surat
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <form method="post" action="{{ route('kirimSurat') }}" enctype="multipart/form-data">
                    @csrf
                
                    <label for="exampleFormControlInput1" class="form-label">Nama Surat</label>
                    <input type="text" class="form-control mb-3" name="nama_surat" value="{{ session('surat_terima.nama_surat') }}" readonly>
                
                    <label for="exampleFormControlInput1" class="form-label">No Surat</label>
                    <input type="text" class="form-control mb-3" name="no_surat" value="{{ session('surat_terima.no_surat') }}" readonly>
                
                    <label for="exampleFormControlInput1" class="form-label">Pengirim</label>
                    <input type="text" class="form-control mb-3" name="pengirim" value="{{ session('surat_terima.pengirim') }}" readonly>
                
                    <label for="exampleFormControlInput1" class="form-label">File Surat</label>
                    <input class="form-control mb-3" type="file" name="nama_file" id="formFile" accept=".pdf">
                
                    <button type="submit" class="btn-first">Tambah</button>
                </form>
                
               
            </div>
        </div>
    </div>
@endsection
