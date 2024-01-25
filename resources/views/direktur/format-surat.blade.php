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
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
        
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            });
        </script>        
    @endif
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
                Format Surat
            </div>
            <a href="/tambah-format"> <button style="width: 100px" class="btn-first mb-4">Tambah Format</button></a>
            <div style="margin: 0" class="row d-flex flex-column mb-4 w-100 p-3 tanda-tangan rounded">
                <table id="tabelSemua" class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Format Surat</th>
                            <th scope="col">Kategori Surat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($format as $item)
                            <tr class="table-primary">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->format_surat }}</td>
                                <td>{{ $item->kategori_surat }}</td>
                                <td>
                                    <a href="/format-surat/tambah/{{$item->id}}/edit">                                    <button style="color: #36CE29" class="btn-first">Edit</button></a>
                                    <form id="deleteForm-{{ $item->id }}" action="/format-surat/tambah/{{ $item->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button onclick="deleteConfirm('deleteForm-{{ $item->id }}')" type="button" style="color: #BE2E40" class="btn-second ms-2">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            {{$format->links()}}
        </div>
    </div>
@endsection
