@extends('layouts.main')

@section('extra-styles')
    <style>
        body {
            background-image: none; /* Menghapus background-image */
            background: #CCDBDC;
        }
    </style>
@endsection
@section('container')
<div class="row">
    <div class="col-md-2 bg-primary sidebar-login">
        <!-- Contoh elemen <li> pada menu -->
            <ul class="d-flex gap-5 flex-column" id="menuList">
                <li class="{{ Request::is('login/direktur*') ? 'active' : '' }}" data-user="direktur" data-url="{{ url('/login/direktur') }}" data-image="{{ asset('img/direktur-login.png') }}" onclick="toggleActive('direktur')">Direktur</li>
                <li class="{{ Request::is('login/sekretaris*') ? 'active' : '' }}" data-user="sekretaris" data-url="{{ url('/login/sekretaris') }}" data-image="{{ asset('img/sekretaris-login.png') }}" onclick="toggleActive('sekretaris')">Sekretaris</li>
                <li class="{{ Request::is('login/kurir*') ? 'active' : '' }}" data-user="kurir" data-url="{{ url('/login/kurir') }}" data-image="{{ asset('img/kurir-login.png') }}" onclick="toggleActive('kurir')">Kurir</li>
            </ul>
            
            
    </div>
    <div class="col-md-10 d-flex align-items-center justify-content-evenly login-content">
            <div class="login-img">
                <img class="img-fluid" id="userImage" src="@if(Request::is('login/direktur*'))
                {{ asset('img/direktur-login.png') }}
            @elseif(Request::is('login/sekretaris*'))
                {{ asset('img/sekretaris-login.png') }}
            @elseif(Request::is('login/kurir*'))
                {{ asset('img/kurir-login.png') }}
            @endif" alt="">
            </div>
            <div class="login-box col-md-12">
                <span style="color: #fff" >Dispo</span><span style="color:#003249;" >Manager</span>
                <div class="row login-heading mt-5 d-flex justify-content-center">
                    Masuk
                </div>
                <div class="row login-tagline mt-3 d-flex justify-content-center">
                    Ayo masuk untuk melakukan akses
                       <br> disposisi surat.
                </div>
                <div class="row mb-5 d-flex login-form justify-content-center">
                    <label style="padding-left: 12px!important;" for="uname">Username</label>
                    <input class="mb-3" type="text"  name="uname" required>
                    <label style="padding-left: 12px!important;" for="psw">Password</label>
                   <input type="password" name="psw" id="">
                </div>
                <div class="row d-flex justify-content-center">
                    <button type="button" class="btn-first">Masuk</button>
                </div>
            </div>
    </div>
</div>
@endsection
