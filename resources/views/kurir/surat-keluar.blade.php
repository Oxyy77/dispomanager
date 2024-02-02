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
                Surat Keluar
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
                      @foreach ($suratKeluar as $item )
                      <tr class="table-primary" >
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->no_surat }}</td>
                        <td> {{$item->nama_surat}} </td>
                        <td>{{ $item->status_pengiriman }}</td>
                        <td>
                          <form action="{{ route('pengiriman.kirimKeluar', $item->id) }}" method="post">
                              @csrf
                              @method('put')
                             @if ($item->status_pengiriman == 'Menunggu Dikirim')
                             <button type="submit" class="btn-first">Kirim</button>
                             @endif
                          </form>
          
                          <form action="{{ route('pengiriman.selesaiKeluar', $item->id) }}" method="post">
                              @csrf
                              @method('put')
                            @if ($item->status_pengiriman == 'Dalam Pengiriman')
                            <button type="submit" class="btn-first">Selesai</button>
                            @else
                            <button type="submit" class="btn-second" disabled>Selesai</button>
                            @endif
                          </form>
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            {{$suratKeluar->links()}}
        </div>
    </div>
@endsection
