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
                      @foreach ($suratMasuk as $surat )
                      <tr class="table-primary" >
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$surat->no_surat}}</td>
                        <td>{{$surat->nama_surat}}</td>
                        <td>{{$surat->status_surat}}</td>
                        <td>
                          <form method="POST" action="{{ route('updateSekre',['id' => $surat->id]) }}">
                            @csrf
                            @method('PATCH')
                            
                            <div style="margin:0" class="row justify-content-end align-items-end h-100">
                                <button type="submit" class="btn-first">Baca</button>
                            </div>
                        </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            {{$suratMasuk->links()}}
        </div>
    </div>
@endsection
