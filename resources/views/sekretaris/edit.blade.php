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
                Edit Format
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <form method="post" action="/sekretaris/format-surat/tambah/{{ $format->id}}">
                    @method('put')
                    @csrf
                    <label for="exampleFormControlInput1" class="form-label">Kategori Surat</label>
                    <input type="text" value="{{$format->kategori_surat}}"
                        class="form-control mb-3 @error('kategori_surat') is-invalid    
                    @enderror"
                        name="kategori_surat" id="exampleFormControlInput1" placeholder="Masukkaan Kategori Surat">
                    @error('kategori_surat')
                        <div style="font-weight:300" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="exampleFormControlInput1" class="form-label">Format Surat</label>
                    <input type="text"
                        class="form-control mb-3 @error('format_surat') is-invalid    
                    @enderror"
                        name="format_surat" id="exampleFormControlInput1" value="{{ $format->format_surat }}" placeholder="Masukkaan Format Surat">
                    @error('format_surat')
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
