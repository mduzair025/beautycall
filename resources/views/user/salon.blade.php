<!-- resources/views/salon_category.blade.php -->

@extends('layouts.master')
@section('title', $categoryName)
@section('content')
@include('partials.user-menu')
<!-- Page Content-->
<section class="py-5">
    <!-- Page Heading/Breadcrumbs-->
    <h1 class="CenterText">{{ $salon->Name }} / {{ $categoryName }}</h1>
    <div class="row">
        <!-- Blog Entries Column-->
        <div class="col-md-4 sideBackground">
            <!-- Search Widget-->
            <div class="col-sm"></div>
            <div class="col-sm center  ">
            </div>
            <div class="row HeaderElement">
                <h1> Category:</h1>
                <div class="dropdown ">

                    <button class="btn btn-secondary dropdown-toggle  " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <h1 class="dropdownText"> {{$categoryName}}</h1>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($categories as $cat) 
                            <a class="dropdown-item" href="{{ route('salon.view', ['salon' => $salon->Name, 'category' => $cat->ServiceCategoryName]) }}">
                                {{$cat['ServiceCategoryName']}}</a>
                        @endforeach
                        </div>
                </div>
            </div>
            <div class="col-sm"></div>
        </div>
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item"></li>
            <li class="page-item disabled"></li>
        </ul>
    </div>

    <div class="col-md-8">
        @foreach ($services as $service)
        <div class="card mb-4">
            <!-- Your PHP logic for the carousel -->
            <div class="card-body">
                <h2 class="card-title">{{ $service->ServiceName }}</h2>
                <p class="card-text">{{ $service->ShortDescription }}</p>
                <a class="btn btn-primary" href="/User/DateSelector.php?ServicePass={{ $service->ServiceName }}&Salonview={{ $salon->Name }}&Categoryview={{ $categoryName }}&Date={{ now() }}">Book→</a>
            </div>
            <div class="card-footer text-muted"><br>
                Time duration: {{ $service->TimeDurationHours }}H:{{ $service->TimeDurationMinutes }}M
                &nbsp &nbsp &nbsp Today: {{ date("l Y.m.d") }}
            </div>
        </div>
        @endforeach
    </div>
    </div>
</section>

<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">
            Salon Informations:<br>
            Country: {{ $salon->Country }} <br>
            Address: {{ $salon->Address }} <br>
            Postal Code: {{ $salon->PostalCode }} <br>
            Email: {{ $salon->Email }} <br>
            Phone Number: {{ $salon->PhoneNumber }}
        </p>
    </div>
</footer>
@endsection
