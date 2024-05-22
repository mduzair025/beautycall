@extends('layouts.master')

@section('title', 'Salon Clients')

@section('content')
@include('partials.salon-menu')

@if(count($clientBookings) > 0)
    @foreach($clientBookings as $client)
        <div class="card-footer text-muted">
            Name: {{ $client['name'] }} {{ $client['surname'] }} <br>
            Total number of bookings: {{ $client['NOB'] }}
        </div>
    @endforeach
@else
    <div style="color:green; font-size:30px; text-align:center;">
        <span>No clients yet!</span>
    </div>
@endif
@endsection