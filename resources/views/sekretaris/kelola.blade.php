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
    <div id="overlay"></div>
    <div id="popup" style="display: none" class="pop-up  flex-column align-items-center gap-5">
        <div class="row mt-3 d-flex flex-row pop-up-header">Tambah Surat <img class="close-ico" onclick="closePopup()"
                style="width: 12px; cursor:pointer;" src="{{ asset('img/close.svg') }}" alt=""> </div>
        <div class="row d-flex flex-column gap-2">
            <a href="/sekretaris/tambah-surat/tambah/create"> <button style="width:90px" class="btn-first">Upload
                    Surat</button></a>
            <a href="/sekretaris/form/buat-surat"><button style="width:90px" class="btn-second">Buat Surat</button></a>
        </div>
    </div>
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
                <button class="btn-first" onclick="openPopup()">Tambah Surat</button>
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                Pengajuan Tanda Tangan Surat

                @foreach ($pengajuan as $item)
                    <div class="card mt-3">
                        <div class="card-body d-flex flex-column">
                            <div style="margin: 0" class="row">
                                <div class="col-md-6">
                                    <div style="margin: 0" class="row mb-2 judul-surat">{{ $item->nama_surat }}</div>
                                    <div class="row mb-2 no-surat" style="margin: 0">{{ $item->no_surat }}</div>
                                    <div class="row d-flex gap-3 button-group" style="margin: 0">
                                        <button class="btn-first">Unduh Surat</button>
                                        <form id="deleteForm-{{ $item->id }}"
                                            action="/sekretaris/tambah-surat/tambah/{{ $item->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button onclick="deleteConfirm('deleteForm-{{ $item->id }}')" type="button"
                                                style="color: #BE2E40" class="btn-second ms-2">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div style="margin:0" class="row justify-content-end align-items-end h-100">
                                        <button class="btn-first">{{ $item->status_pengajuan }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{ $pengajuan->links() }}
        </div>
    </div>
    <script>
        function openPopup() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }
    </script>
@endsection
