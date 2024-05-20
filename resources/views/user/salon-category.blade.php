<!-- resources/views/salon_category.blade.php -->

@extends('layouts.master')
@section('title', $category)
@section('content')
    @include('partials.user-menu')
    <h1 id="HomePageCategories">Category: {{ $category }}</h1>
    <br>
    <div class="container-fluid centralContent">
        @if ($salons->count() > 0)
            @foreach ($salons as $salon)
                
                <a href="{{ route('salon.view', ['salon' => $salon->Name, 'category' => $category]) }}">
                    <section class="py-5">
                        <div class="container">
                            <div class="row SalonRow">
                                <div class="col-lg-6">
                                    <h2 class="mb-4 SalonName">{{ $salon->Name }}</h2>
                                    <p>{{ $salon->ShortDescription }}</p>
                                    <p>This service provider have this categories:</p>
                                    @php
                                        $GETACategory1 = \DB::table('service_providers')
                                            ->join('services', 'service_providers.id', '=', 'services.ServiceProviderID')
                                            ->join('service_categories', 'services.ServiceCategoryID', '=', 'service_categories.id')
                                            ->where('service_providers.Name', $salon->Name)
                                            ->distinct()
                                            ->limit(5)
                                            ->get();
                                    @endphp

                                    @foreach ($GETACategory1 as $row3)
                                        <li>{{ $row3->ServiceCategoryName }}</li>
                                    @endforeach
                                    <p>Here are some informations about the service provider:</p>
                                    <ul>
                                        <li>City: {{ $salon->City }}</li>
                                        <li>Address: {{ $salon->Address }}</li>
                                        <li>Average salon rating: {{ $salon->AverageSalonRating }}</li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <img class="img-fluid rounded" src="{{ $salon?->ImageName }}" alt="SalonImages" />
                                </div>
                            </div>
                        </div>
                    </section>
                </a>
            @endforeach
        @else
            <h1 style="text-align: center; color: red;">No salons have this category yet</h1>
        @endif
    </div>
@endsection
