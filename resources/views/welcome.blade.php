@extends('layouts.main')
@section('container')
       <section id="welcomePage">
        <div class="row">
            <div class="col-md-6 welcome-text">
                <h1 id="myElement"></h1>
                <p class="pt-3" >Mengoptimalkan Alur Surat dengan <br> Solusi Disposisi Terbaik.</p>
            </div>
            <div class="col-md-6 d-flex justify-content-end welcome-img">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators gap-3" style="bottom: -40px">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active" data-bs-interval="2000">
                        <img src="img/example.png" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item" data-bs-interval="2000">
                        <img src="img/example.png" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item" data-bs-interval="2000">
                        <img src="img/example.png" class="d-block w-100" alt="...">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon visually-hidden" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon visually-hidden" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="box-login d-flex flex-row justify-content-evenly align-items-center">
                <div class="box-child d-flex flex-column justify-content-center align-items-center gap-3">
                    <h4>Direktur</h4>
                    <img src="img/direktur.png" alt="">
                    <a href="{{ route('login', 'direktur') }}"><button type="button" class="btn-first">Masuk</button></a>
                </div>
                <div class="box-child d-flex flex-column justify-content-center align-items-center gap-3">
                    <h4>Sekretaris</h4>
                    <img src="img/sekretaris.png" alt="">
                    <a href="{{ route('login', 'sekretaris') }}"><button type="button" class="btn-first">Masuk</button></a>
                </div>
                <div class="box-child d-flex flex-column justify-content-center align-items-center gap-3">
                    <h4>Kurir</h4>
                    <img src="img/kurir.png" alt="">
                    <a href="{{ route('login', 'kurir') }}"><button type="button" class="btn-first">Masuk</button></a>
                </div>
            </div>
        </div>
       </section>
    @endsection