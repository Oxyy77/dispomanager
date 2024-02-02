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
                Kelola Surat
            </div>
            <div style="margin: 0" class="row mb-4 kelola-tambah">
                Buat Surat
            </div>
            <form action="{{ route('update.step2') }}" method="post" id="myForm">
                @csrf
                <label for="mytextarea" class="form-label">Salam Pembuka</label>
                <textarea id="mytextarea" name="salam_pembuka">{{$salamPembuka}}</textarea>
               
                <button type="button" class="btn-first mt-3" onclick="updateDatabase()">Selanjutnya</button>
            </form>
            
            
        </div>
    </div>
    <script>
        tinymce.init({
          selector: '#mytextarea', // Replace this CSS selector to match the placeholder element for TinyMCE
          plugins: 'code table lists',
          toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
      </script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         
        function updateDatabase() {
            // Get the content from TinyMCE editor
            var salamPembukaContent = tinymce.get('mytextarea').getContent();
    
            // Set the content to the hidden input field
            $('[name="salam_pembuka"]').val(salamPembukaContent);
    
            // Submit the form using Ajax
            $.ajax({
                url: $('#myForm').attr('action'),
                method: 'POST',
                data: $('#myForm').serialize(),
                success: function(response) {
                    console.log(response);
                    if (response && response.success) {
                // Redirect to the next page
                window.location.href = '/sekretaris/form/buat-surat/step/3';
            } else {
                // Handle other cases if needed
                console.log(error);
                console.log(error);
            }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>


@endsection
