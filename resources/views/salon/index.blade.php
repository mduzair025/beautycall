@extends('layouts.master')
@section('title', 'Salon Home')
@section('content')
@include('partials.salon-menu')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mb-4">
            <iframe style="width: 100%; height: 650px; border: 0" 
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBv8MQOQ5LKn7PPzSVQcvJK2XSjTgFjEkc&q={{ $salon["City"] . ' ' . $salon["Address"] }}">
            </iframe>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card h-90">
                @if(isset($salon["Image"]))
                    <div class="col-lg-6">
                        <img style="height: 300px; width: 425px;" class="card-img-top" src="/Images/SalonImages/{{ $salon["Image"] }}" alt="SalonImages">
                    </div>
                @endif

                <div class="card-body">
                    <h4 class="card-title"><a href="#!">Information:</a></h4>
                    <p class="card-text">
                        Country: {{ $salon["Country"] }} <br>
                        Postal Code: {{ $salon["PostalCode"] }} <br>
                        Address: {{ $salon["Address"] }} <br>
                        Phone: {{ $salon["PhoneNumber"] }} <br>
                        Email: {{ $salon["Email"] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection