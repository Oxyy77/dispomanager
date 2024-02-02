@extends('layouts.main')
@section('extra-styles')
    <style>
        body {
            background-image: none;
            /* Menghapus background-image */
            background: #FFF;
        }
    </style>
     <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            /* border: 1px solid black; */
            padding: 8px;
          
        }
    </style>
@endsection
@section('container')
<div class="row">
    <div class="col-md-2">
        @include('partials.sekretaris.sidebar')
    </div>
    <div style="padding:3rem!important;" class="col-md-10">
       <div class="besar-surat">
        <table border="1">
            <!-- Baris 1 -->
            <colgroup>
                <col style="width: 4cm;"> <!-- Column 1 -->
                <col style="width: 11cm;"> <!-- Column 2 -->
                <col style="width: auto;"> <!-- Column 3 (auto width) -->
            </colgroup>
            <tr>
                <td style="height: 2.5cm; width:15cm;" class="text-center" colspan="3"><img style="height: 2.5cm; width:15cm;" src="{{ asset($kopSurat) }}" alt="Kop Surat">
                </td>
            </tr>
            
            <!-- Baris 2 -->
            <tr>
                <td class="text-end" colspan="3">{{$tanggalSurat}}</td>
            </tr>
            
            <!-- Baris 3 -->
            <tr  >
                <td  >Nomor</td>
                <td colspan="2"  >: {{$nomorSurat}}</td>
                
            </tr>
            
            <!-- Baris 4 -->
            <tr>
                <td  >Hal</td>
                <td colspan="2" >: {{$hal}}</td>
                
            </tr>
            
            <!-- Baris 5 -->
            <tr>
                <td>Lampiran</td>
                <td colspan="2" >: {{$lampiran}}</td>
              
            </tr>
            
            <!-- Baris 6 -->
            <tr>
                <td colspan="3"></td>
            </tr>
            
            <!-- Baris 7 -->
            <tr>
                <td colspan="2">Yth {{$tujuan}}</td>
                <!-- Isi kolom 2 -->
                <td></td>
            </tr>
            
            <!-- Baris 8 -->
            <tr>
                <td colspan="2">{{$alamat}}</td>
                <!--  2 -->
                <td></td>
            </tr>
            
            <!-- Baris 9 - 14 -->
            <tr>
                <td colspan="3" ></td>
            </tr>
            <tr>
                <td colspan="3" >{!! html_entity_decode(strip_tags($salamPembuka)) !!}</td>
            </tr>
            <tr>
                <td colspan="3">{!! $isiSurat !!}
                </td>
            </tr>
            <tr>
                <td colspan="3">{!! html_entity_decode(strip_tags($salamPenutup)) !!}</td>
            </tr>
            <tr>
                <td class="text-center" colspan="3">Hormat Kami,</td>
            </tr>
            <tr>
                <td class="text-center" colspan="3">CV. Putra Anugrah Mandiri</td>
            </tr>
            
            <!-- Baris 15 -->
            <tr >
                <td class="text-center w-50"  colspan="2">
                   <p> Direktur</p>
                    <div style="margin:0 auto;" class="box-ttd">
                    </div>
                    <p>Nama Direktur</p>
                </td>
                <!-- Isi kolom 2 -->
                <td class="text-center" >
                   <p>Sekretaris</p>
                    <div style="margin:0 auto;" id="box-ttd" class="box-ttd"></div>
                    <p>Nama Sekretaris</p>
                </td>
            </tr>
        </table>
       </div>
       <input type="file" accept="image/*" id="uploadInput" style="display: none;">

       <!-- Display uploaded image -->
       <div id="uploadedImage" class="uploaded-ttd"></div>

       <!-- Your existing button -->
       <button class="btn-first" onclick="document.getElementById('uploadInput').click();">Tambah TTD</button>

</div>
</div>
<script>
    document.getElementById('uploadInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        const boxTtd = document.getElementById('box-ttd');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('uploaded-ttd-img');

                // Set width and height attributes for the uploaded image
                imgElement.width = 200;
                imgElement.height = 150;

                // Replace the box-ttd element with the new image
                boxTtd.parentNode.replaceChild(imgElement, boxTtd);
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    });
</script>


@endsection
