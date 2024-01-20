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
                Surat Masuk
            </div>
            
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <table id="tabelSemua" class="table table-secondary">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Nama Surat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="table-primary" >
                        <th scope="row">1</th>
                        <td>001/pam-techno/U</td>
                        <td>Undangan Rapat</td>
                        <td>Belum Dikirim</td>
                        <td><button class="btn-first">Edit</button></td>
                      </tr>
                      <tr class="table-secondary" >
                        <th scope="row">2</th>
                        <td>001/pam-techno/U</td>
                        <td>Undangan Rapat</td>
                       <td>Belum Dikirim</td>
                       <td><button class="btn-first">Edit</button></td>
                      </tr>
                      <tr class="table-primary" >
                        <th scope="row">3</th>
                        <td>001/pam-techno/U</td>
                        <td>Undangan Rapat</td>
                       <td>Belum Dikirim</td>
                       <td><button class="btn-first">Edit</button></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
