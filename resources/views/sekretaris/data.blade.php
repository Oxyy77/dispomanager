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
                  @foreach ($semuaSurat as $semua )
                  <tr class="table-primary" >
                    <th scope="row"> {{$loop->iteration}} </th>
                    <td> {{$semua->no_surat}} </td>
                    <td> {{$semua->nama_surat}} </td>
                    <td>  {{$semua->jenis_surat}}  </td>
                    <td> {{$semua->status_surat}} </td>
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
                    <th scope="row"> {{$loop->iteration}} </th>
                    <td> {{$masuk->no_surat}} </td>
                    <td> {{$masuk->nama_surat}} </td>
                    <td> {{$masuk->jenis_surat}} </td>
                    <td> {{$masuk->status_surat}} </td>
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
                      <th scope="row"> {{$loop->iteration}} </th>
                      <td> {{$keluar->no_surat}} </td>
                      <td> {{$keluar->nama_surat}} </td>
                      <td> {{$keluar->jenis_surat}} </td>
                      <td> {{$keluar->status_surat}} </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            {{$semuaSurat->links()}}
        </div>
    </div>
@endsection
