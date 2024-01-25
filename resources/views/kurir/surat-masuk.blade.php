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
            <div style="margin: 0" class="row mb-3 dashboard-header">
                Surat Masuk
            </div>
              <a href="/kurir/surat-masuk/create"><button class="btn-first mb-3">Tambah</button></a>
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
                      
                      @foreach ($pengiriman as $item )
                    
                      <tr class="table-primary" >
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->no_surat }}</td>
                        <td> {{ $item->nama_surat }} </td>
                        <td> {{ $item->status_pengiriman }} </td>
                        <td>
                          @if ($item->status_pengiriman != 'Selesai')
                              <form action="{{ route('pengiriman.kirim', $item->id) }}" method="post">
                                  @csrf
                                  @method('put')
                                  <button type="submit" class="btn-first" {{ $item->status_pengiriman == 'Dalam Pengiriman' ? 'disabled' : '' }}>Kirim</button>
                              </form>
                          @endif
                      
                          <form action="{{ route('pengiriman.selesai', $item->id) }}" method="post">
                              @csrf
                              @method('put')
                              <button type="submit" class="btn-second" {{ $item->status_pengiriman == 'Selesai' ? 'disabled' : '' }}>
                                  Selesai
                              </button>
                          </form>
                      </td>
                      
                      
                      
                      </tr>
                      @endforeach
                 
                    </tbody>
                  </table>
            </div>
            {{$pengiriman->links()}}
        </div>
    </div>
@endsection
