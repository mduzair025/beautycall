<!-- resources/views/salon_category.blade.php -->

@extends('layouts.master')
@section('title', request()->Salonview .':'. request()->ServicePass)
@section('content')
@include('partials.user-menu')

<section class="py-5">
<div class="container">
    <!-- Page Heading/Breadcrumbs-->
    <h1>{{ request()->Salonview }}: {{ request()->ServicePass }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="
        {{route('user.bookings.date-selector')}}?ServicePass={{ request()->ServicePass }}&Salonview={{ request()->Salonview }}&Categoryview={{ request()->Categoryview }}&Date={{ now() }}
        ">Change Dates</a></li>
        <li class="breadcrumb-item active">Choose the Staff</li>
    </ol>

    @if(isset($staffAvailability))
        @foreach($staffAvailability as $staff)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="card-title">{{ $staff['name'] }}</h2>
                            <a href="#!">
                             @php
                                $image = $staff['image'] ?? '/assets/images/DefaultProfileImage.jpeg';
                                $imageUrl = (strpos($image, 'https') === 0) ? $image : asset($image);
                            @endphp
                            <img class="img-fluid rounded" src="{{$imageUrl}}" alt="staffImage" />
                            </a>
                        </div>

                        <div class="col-lg-6">
                            <h2 class="card-title">These are the available intervals.</h2>
                            <p class="card-text">Choose the time you want to start the booking:</p>
                            @foreach($staff['intervals'] as $interval)
                                @if($interval['start'] == $interval['end'])
                                    <p>Booked all day!</p>
                                @else
                                    <form method="POST" action="{{ route('user.bookings.confirm', ['ServicePass' => request()->ServicePass, 'Salonview' => request()->Salonview, 'Categoryview' => request()->Categoryview]) }}">
                                        @csrf
                                        <p>Available from {{ $interval['start'] }} to {{ $interval['end'] }}</p>
                                        <input required min="{{ $interval['start'] }}" max="{{ $interval['end'] }}" type="time" name="InsertBeginTime">
                                        <input type="hidden" value="{{ $staff['id'] }}" name="StaffID">
                                        <input type="hidden" value="{{ request()->date }}" name="Date">
                                        <button type="submit" name="ConfirmBooking" class="btn btn-primary btn-sm">Confirm Booking</button>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">Staff: {{ $staff['name'] }}</div>
            </div>
        @endforeach
    @else
        <p>No staff available yet</p>
    @endif
</div>
</section>
@endsection