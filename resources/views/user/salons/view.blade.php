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
                        <a class="dropdown-item" href="{{ route('user.salon.view', ['salon' => $salon->Name, 'category' => $cat->ServiceCategoryName]) }}">
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

        <div class="col-md-8">
            @foreach ($services as $service)
            <div class="card mb-4">
                <!-- Your PHP logic for the carousel -->
                <div class="card-body">
                    @php
                        $image = $service->ServiceImage ?? '/images/DefaultProfileImage.jpeg';
                        $imageUrl = (strpos($image, 'https') === 0) ? $image : asset($image);
                    @endphp
                    <img class="card-img-top" src="{{$imageUrl}}" alt="ServiceCategoryImage">
                    <h2 class="card-title">{{ $service->ServiceName }}</h2>
                    <p class="card-text">{{ $service->ShortDescription }}</p>
                    <a class="btn btn-primary" href="{{route('user.bookings.date-selector')}}?ServicePass={{ $service->ServiceName }}&Salonview={{ $salon->Name }}&Categoryview={{ $categoryName }}&Date={{ now() }}">Book→</a>
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

    <p class="m-0 text-center text-white">
        Salon Informations:<br>
        Country: {{ $salon->Country }} <br>
        Address: {{ $salon->Address }} <br>
        Postal Code: {{ $salon->PostalCode }} <br>
        Email: {{ $salon->Email }} <br>
        Phone Number: {{ $salon->PhoneNumber }}
    </p>

</footer>
@endsection
