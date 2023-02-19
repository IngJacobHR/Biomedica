@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="8000">
                        <div class="carousel-caption d-none d-md-block">
                        <h5 class="display-4 text-primary">Ingeniería y Mantenimiento Coopsana IPS</h5>
                         <p></p>
                        </div>
                        <img class="img-fluid mb-4" src="/biomedica/storage/app/public/img/inicio.svg" alt="">
                    </div>
                    <div class="carousel-item" data-bs-interval="8000">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="display-4 text-primary">Ingeniería y Mantenimiento Coopsana IPS</h5>
                            <p></p>
                        </div>
                        <img class="img-fluid mb-4" src="/biomedica/storage/app/public/img/costruccion.svg" alt="">
                    </div>
                    <div class="carousel-item " data-bs-interval="8000">
                        <img class="img-fluid mb-4" src="/biomedica/storage/app/public/img/datos.svg" alt="">
                        <div class="carousel-caption d-none d-md-block">
                        <h5 class="display-4 text-primary">Ingeniería y Mantenimiento Coopsana IPS</h5>
                        <p></p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"  data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"  data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
