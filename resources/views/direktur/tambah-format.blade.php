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
                Tambah Format
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <label for="exampleFormControlInput1" class="form-label">Kategori Surat</label>
                <input type="text" class="form-control mb-3" id="exampleFormControlInput1"
                    placeholder="Masukkaan Kategori Surat">
                <label for="exampleFormControlInput1" class="form-label">Format Surat</label>
                <input type="text" class="form-control mb-3" id="exampleFormControlInput1"
                    placeholder="Masukkaan Format Surat">
                <button class="btn-first">Tambah</button>
            </div>
        </div>
    </div>
@endsection
