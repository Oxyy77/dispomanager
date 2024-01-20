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
                <label for="exampleFormControlInput1" class="form-label">Nama Surat</label>
                <input type="text" class="form-control mb-3" id="exampleFormControlInput1"
                    placeholder="Masukkaan Nama Surat">
                    <label for="kategori-surat">Kategori Surat</label>
                <select id="kategori-surat" class="form-select mb-3" aria-label="Default select example">
                    <option selected>Pilih Kategori Surat</option>
                    <option value="1">Undangan</option>
                    <option value="2">Sertifikat</option>
                    <option value="3">Pengumuman</option>
                </select>
                <label for="no-surat">No Surat</label>
                <select id="no-surat" class="form-select mb-3" aria-label="Default select example">
                    <option selected>Pilih No Surat</option>
                    <option value="1">001/pt/1</option>
                    <option value="2">001/pt/2</option>
                    <option value="3">001/pt/3</option>
                </select>
                <label for="formFile" class="form-label">Upload Surat</label>
                <input class="form-control mb-3" type="file" id="formFile">
                <button class="btn-first">Tambah</button>
            </div>
        </div>
    </div>
@endsection
