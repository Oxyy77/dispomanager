@extends('layouts.main')
@section('extra-styles')
    <style>
        body {
            background-image: none; /* Menghapus background-image */
            background: #FFF;
        }
    </style>
@endsection
@section('container')
<div class="row d-flex flex-row">
    <div class="col-md-2">
        @include('partials.kurir.sidebar')
    </div>
    <div style="padding:3rem!important;" class="col-md-10">
        <div style="margin: 0" class="row mb-4 dashboard-header">
            Dashboard Kurir
        </div>
        <div style="margin: 0" class="row justify-content-center gap-4">
            <div class="card-dashboard mb-4">
                <div class="card card-urgent h-100 p-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center justify-content-end">
                            <img class="" style="width: 16px" src="{{asset('img/ico-kelola.png')}}" alt="">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="circle">
                                    <p>12</p>
                                </div>
                            </div>
                            <div class="col-md-6 card-message d-flex align-items-center">
                                Surat Perlu <br> Di Kirim
                            </div>
                        </div>
                        <div class="row card-alert">Segera Antarkan Surat</div>
                    </div>
                </div>
            </div>
            <div class="card-dashboard mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center justify-content-end">
                            <img class="" style="width: 16px" src="{{asset('img/ico-kelola.png')}}" alt="">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="circle">
                                    <p>20</p>
                                </div>
                            </div>
                            <div class="col-md-6 card-message d-flex align-items-center">
                                Surat Masuk <br> Minggu Ini
                            </div>
                        </div>
                        <div class="row card-alert">Dikirim Minggu Ini</div>
                    </div>
                </div>
            </div>
            <div class="card-dashboard mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center justify-content-end">
                            <img class="" style="width: 16px" src="{{asset('img/ico-kelola.png')}}" alt="">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="circle">
                                    <p>5</p>
                                </div>
                            </div>
                            <div class="col-md-6 card-message d-flex align-items-center">
                                Surat Keluar <br> Minggu Ini
                            </div>
                        </div>
                        <div class="row card-alert">Dikirim Minggu Ini</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin: 0" class="row mb-4 dashboard-header">
            Surat Terakhir
        </div>
        <div style="margin: 0" class="row">
            <ul id="kategori" class="kategori-table d-flex gap-3">
                <li class="active" onclick="pilihKategori(this)">Semua</li>
                <li onclick="pilihKategori(this)">Surat Masuk</li>
                <li onclick="pilihKategori(this)">Surat Keluar</li>
            </ul>
        </div>
        <div style="margin: 0" class="row">
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
                    <td>Pengiriman</td>
                    <td>Pengiriman</td>
                  </tr>
                  <tr class="table-secondary" >
                    <th scope="row">2</th>
                    <td>001/pam-techno/U/12</td>
                    <td>Undangan Rapat</td>
                    <td>Pengiriman</td>
                    <td>Pengiriman</td>
                  </tr>
                  <tr class="table-primary" >
                    <th scope="row">3</th>
                    <td>001/pam-techno/U/12</td>
                    <td>Undangan Rapat</td>
                    <td>Pengiriman</td>
                    <td>Pengiriman</td>
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
                    <td>Pengiriman</td>
                    <td>Pengiriman</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>001/pam-techno/U/12</td>
                    <td>Undangan Rapat</td>
                    <td>Pengiriman</td>
                    <td>Pengiriman</td>
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
                    <td>Pengiriman</td>
                    <td>Pengiriman</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection