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
            @include('partials.sidebar')
        </div>
        <div style="padding:3rem!important;" class="col-md-10">
            <div style="margin: 0" class="row mb-4 dashboard-header">
                Tambah Kode
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <form method="post" action="/format-surat/tambah">
                    @csrf
                    <label for="exampleFormControlInput" class="form-label">Kategori Surat</label>
                    <input type="text"
                        class="form-control mb-3 @error('kategori_surat') is-invalid @enderror"
                        name="kategori_surat" id="exampleFormControlInput" placeholder="Masukkan Kategori Surat"
                        value="{{ old('kategori_surat') }}">
                    @error('kategori_surat')
                        <div style="font-weight:300" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                
                    <label for="exampleFormControlInput1" class="form-label">Format Surat</label>
                    <input type="text"
                        class="form-control mb-3 @error('format_surat') is-invalid @enderror"
                        name="format_surat" id="exampleFormControlInput1" placeholder="ex: PT/U"
                        value="{{ old('format_surat') }}">
                    <input type="hidden" id="hiddenAdditionalInfo" name="hidden_additional_info" value="{{ old('hidden_additional_info') }}">
                
                    @error('format_surat')
                        <div style="font-weight:300" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="include_month_year"
                            {{ old('include_month_year') ? 'checked' : '' }}>
                        <label style="color: #003249;
                        text-align: center;
                        font-family: Montserrat;
                        font-size: 12px;
                        font-style: normal;
                        font-weight: 400;
                        line-height: normal;" class="form-check-label" for="flexCheckDefault">
                            Sertakan Bulan dan Tahun Pada Kode Surat
                        </label>
                    </div>
                
                    <button type="submit" class="btn-first">Tambah</button>
                </form>
                
               
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var checkbox = document.getElementById('flexCheckDefault');
            var formatSuratInput = document.getElementById('exampleFormControlInput1');
            var hiddenInput = document.getElementById('hiddenAdditionalInfo');
    
            checkbox.addEventListener('change', function () {
                var tambahan = '/[bln]/[thn]';
                var currentValue = formatSuratInput.value;
    
                if (checkbox.checked) {
                    // Checkbox checked, tambahkan /[bln]/[thn] pada hiddenInput
                    hiddenInput.value = tambahan;
                } else {
                    // Checkbox unchecked, hapus /[bln]/[thn] dari hiddenInput
                    hiddenInput.value = '';
                }
            });
    
            // Menggunakan event 'submit' untuk menyisipkan nilai ke dalam formatSuratInput sebelum formulir dikirim
            document.getElementById('yourFormId').addEventListener('submit', function () {
                // Sisipkan nilai dari hiddenInput ke dalam formatSuratInput sebelum mengirim formulir
                formatSuratInput.value += hiddenInput.value;
            });
        });
    </script>
    
    
    
@endsection
