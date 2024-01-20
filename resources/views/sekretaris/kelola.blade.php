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
            @include('partials.sekretaris.sidebar')
        </div>
        <div style="padding:3rem!important;" class="col-md-10">
            <div style="margin: 0" class="row mb-4 dashboard-header">
                Kelola Surat
            </div>
            <div style="margin: 0" class="row mb-4 kelola-tambah">
                Tambah Surat
            </div>
            <div style="margin: 0" class="row mb-4 button-tambah">
                <a href="/tambah-surat"><button class="btn-first">Tambah Surat</button></a>
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                Pengajuan Tanda Tangan Surat
                <div class="card mt-3">
                    <div class="card-body d-flex flex-column">
                        <div style="margin: 0" class="row">
                            <div class="col-md-6">
                                <div style="margin: 0" class="row mb-2 judul-surat">Undangan Rapat</div>
                                <div class="row mb-2 no-surat" style="margin: 0">001/pam-techno/U/12</div>
                                <div class="row d-flex gap-3 button-group" style="margin: 0">
                                    <button class="btn-first">Unduh Surat</button>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin:0" class="row justify-content-end align-items-end h-100">
                                    <button class="btn-first">Ajukan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body d-flex flex-column">
                        <div style="margin: 0" class="row">
                            <div class="col-md-6">
                                <div style="margin: 0" class="row mb-2 judul-surat">Undangan Rapat</div>
                                <div class="row mb-2 no-surat" style="margin: 0">001/pam-techno/U/12</div>
                                <div class="row d-flex gap-3 button-group" style="margin: 0">
                                    <button class="btn-first">Unduh Surat</button>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin:0" class="row justify-content-end align-items-end h-100">
                                    <button class="btn-first">Ajukan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body d-flex flex-column">
                        <div style="margin: 0" class="row">
                            <div class="col-md-6">
                                <div style="margin: 0" class="row mb-2 judul-surat">Undangan Rapat</div>
                                <div class="row mb-2 no-surat" style="margin: 0">001/pam-techno/U/12</div>
                                <div class="row d-flex gap-3 button-group" style="margin: 0">
                                    <button class="btn-first">Unduh Surat</button>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin:0" class="row justify-content-end align-items-end h-100">
                                    <button class="btn-first">Ajukan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
