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
                Surat Masuk
            </div>
            <div style="margin: 0" class="row">
                <ul id="kategori" class="kategori-table d-flex gap-3">
                    <li class="active" onclick="pilihKategori(this)">Semua</li>
                    <li onclick="pilihKategori(this)">Surat Masuk</li>
                    <li onclick="pilihKategori(this)">Surat Keluar</li>
                </ul>
            </div>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <table id="tabelSemua" class="table table-secondary">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Nama Surat</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="table-primary" >
                        <th scope="row">1</th>
                        <td>001/pam-techno/U/12</td>
                        <td>Undangan Rapat</td>
                        <td>Surat Masuk</td>
                        <td>Surat Masuk</td>
                      </tr>
                      <tr class="table-secondary" >
                        <th scope="row">2</th>
                        <td>001/pam-techno/U/12</td>
                        <td>Undangan Rapat</td>
                        <td>Surat Masuk</td>
                        <td>Surat Masuk</td>
                      </tr>
                      <tr class="table-primary" >
                        <th scope="row">3</th>
                        <td>001/pam-techno/U/12</td>
                        <td>Undangan Rapat</td>
                        <td>Surat Masuk</td>
                        <td>Surat Masuk</td>
                      </tr>
                    </tbody>
                  </table>
                  <table id="tabelMasuk" class="table hidden">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Nama Surat</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>001/pam-techno/U/12</td>
                        <td>Undangan Rapat</td>
                        <td>Surat Masuk</td>
                        <td>Surat Masuk</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>001/pam-techno/U/12</td>
                        <td>Undangan Rapat</td>
                        <td>Surat Masuk</td>
                        <td>Surat Masuk</td>
                      </tr>
                    </tbody>
                  </table>
                  <table id="tabelKeluar" class="table hidden">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Nama Surat</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>001/pam-techno/U/12</td>
                        <td>Undangan Rapat</td>
                        <td>Surat Masuk</td>
                        <td>Surat Masuk</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
