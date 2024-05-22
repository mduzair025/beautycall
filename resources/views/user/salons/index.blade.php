@extends('layouts.master')
@section('title', 'Main Providers')
@section('content')
@include('partials.user-menu')

<section class="py-5 bg-light">
    <div class="container">
        <h2 id="HomePageCategories">@yield('title')</h2>


        <form action="{{ route('user.salon.get-salons') }}" method="post" class="">
            @csrf
            <input class="form-control" type="text" name="search" placeholder="Search.."> <br>
            <div class="result"></div>
        </form>

        @foreach($salons as $salon)
        <a href="{{ route('user.salon.view', ['salon' => $salon->Name, 'category' => $salon->defaultCategory]) }}">
            <section class="py-5">
                <div class="container">
                    <div class="row SalonRow">
                        <div class="col-lg-6">
                            <h2 class="mb-4 SalonName">{{ $salon->Name }}</h2>
                            <p>{{ $salon->ShortDescription }}</p>
                            <p>This service provider has these categories and much more:</p>
                            <ul>
                                @foreach($salon->categories as $category)
                                <li>{{ $category->ServiceCategoryName }}</li>
                                @endforeach
                            </ul>
                            <p>Here is some information about the service provider:</p>
                            <ul>
                                <li>City: {{ $salon->City }}</li>
                                <li>Address: {{ $salon->Address }}</li>
                                <li>Average salon rating: {{ $salon->AverageSalonRating }}</li>
                            </ul>
                        </div>
                        @if($salon->image)
                            @php
                                $image = $salon->image->ImageName ?? '/images/DefaultProfileImage.jpeg';
                                $imageUrl = (strpos($image, 'https') === 0) ? $image : asset($image);
                            @endphp
                            <div class="col-lg-6">
                                <img class="img-fluid rounded" src="{{$imageUrl}}" alt="salonImage" />
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </a>
        @endforeach

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type="text"]').on("keyup input", function() {
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("{{ route('user.salon.get-salons') }}", {
                        term: inputVal
                    }).done(function(data) {
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });
        });

    </script>
    @endsection
