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
            Surat Masuk
        </div>


        <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
            <a href="{{ url()->previous() }}" class="btn btn-first mb-3">Kembali</a>
            
        <iframe height="400" src="{{ $url }}" frameborder="0"></iframe>
        </div>
    </div>
</div>

@endsection
