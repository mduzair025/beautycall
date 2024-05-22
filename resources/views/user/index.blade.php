@extends('layouts.master')
@section('title', 'User Home')
@section('content')
@include('partials.user-menu')
<header>
    <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
        <ol class="carousel-indicators">
            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('assets')}}/images/GeneralImages/Fierst.jpeg" alt="PresentationImage" width="" height="">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Hairstyle</h3>
                    <p>Here you can find the best service provider based on category in your city.</p>
                </div>
            </div>
            <div class="carousel-item">

                <img class="d-block w-100" src="{{asset('assets')}}/images/GeneralImages/Second.jpeg" alt="PresentationImage" width="" height="">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Makeup</h3>
                    <p>Here you can find the best service provider based on category in your city.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('assets')}}/images/GeneralImages/Thirth.jpeg" alt="PresentationImage" width="" height="">
                <div class="carousel-caption d-none d-md-block">
                    <h3>And much more..</h3>
                    <p>Here you can find the best service provider based on category in your city.</p>
                </div>
            </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            Prev
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            Next
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>
<section class="py-5">
    <div class="container">
        <h1 class="mb-4">BeautyCall, the future!</h1>
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card h-100">
                    <h3 class="card-header">Rapidity</h3>
                    <div class="card-body">
                        <p class="card-text">BeautyCall helps you not to queue. Simply choose your service provider, your needed service, and book at the time you want. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card h-100">
                    <h3 class="card-header">Innovativeness</h3>
                    <div class="card-body">
                        <p class="card-text">BeautyCall innovates the way you organise your time.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <h3 class="card-header">Convenience</h3>
                    <div class="card-body">
                        <p class="card-text">The service is free and gives you bonuses and sales at your favorite service provider.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="my-0" />
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4">Main Categories</h2>
        <div class="row">
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card h-100">
                    <a href="{{route('user.category.view', ['category' => 'Hairstyle'])}}"><img class="card-img-top" src="{{asset('assets')}}/images/ServiceCategoryImages/hairstyle.jpeg" alt="Hairstyle" width="" height=""></a>
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{route('user.category.view', ['category' => 'Hairstyle'])}}">Hairstyle</a></h3>
                        <p class="card-text">Chose your favourite hairdressing salon.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card h-100">
                    <a href="{{route('user.category.view', ['category' => 'Makeup'])}}"><img class="card-img-top" src="{{asset('assets')}}/images/ServiceCategoryImages/makeup.jpeg" alt="Makeup" width="" height=""></a>
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{route('user.category.view', ['category' => 'Makeup'])}}">Makeup</a></h3>
                        <p class="card-text">Do your makeup.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card h-100">
                    <a href="{{route('user.category.view', ['category' => 'Tattoos'])}}"><img class="card-img-top" src="{{asset('assets')}}/images/ServiceCategoryImages/tattoo.jpeg" alt="Tattoos" width="" height=""></a>
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{route('user.category.view', ['category' => 'Tattoos'])}}">Tattoos</a></h3>
                        <p class="card-text">Have a tattoo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="py-5 bg-dark">
    
    <p class="m-0 text-center text-white">Made by Cristian Plop</p>
    
</footer>
@endsection
