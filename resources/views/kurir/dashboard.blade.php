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
                                    <p>{{$pengiriman}}</p>
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
                                    <p>{{$jumlahSuratMasuk}}</p>
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
                                    <p>{{$jumlahSuratKeluar}}</p>
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
                  @foreach ($semuaSurat as $semua )
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$semua->no_surat}}</td>
                    <td>{{$semua->nama_surat}}</td>
                    <td>{{$semua->jenis_surat}}</td>
                    <td>{{$semua->status_pengiriman}}</td>
                  </tr>
                  @endforeach
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
                    @foreach ($suratMasuk as $masuk )
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$masuk->no_surat}}</td>
                      <td>{{$masuk->nama_surat}}</td>
                      <td>{{$masuk->jenis_surat}}</td>
                      <td>{{$masuk->status_pengiriman}}</td>
                    </tr>
                    @endforeach
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
                    @foreach ($suratKeluar as $keluar )
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$keluar->no_surat}}</td>
                      <td>{{$keluar->nama_surat}}</td>
                      <td>{{$keluar->jenis_surat}}</td>
                      <td>{{$keluar->status_pengiriman}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection