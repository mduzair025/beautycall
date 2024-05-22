@extends('layouts.master')

@section('title', 'Salon Bookings')

@section('content')
@include('partials.salon-menu')

<div class="row mb-4">
    <div class="col">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Date:
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=Newer">Newer</a>
                <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=Older">Older</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Staff:
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($staffs as $staff)
                    <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=StaffID&StaffName={{$staff}}">{{ $staff }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category:
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($categories as $category)
                    <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=CategoryName&CategoryPass={{$category}}">{{ $category }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Service:
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($services as $service)
                    <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=ServiceID&ServicePass={{$service}}">{{ $service }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Status:
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=BookingStatus&StatusName=Booked">Booked</a>
                <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=BookingStatus&StatusName=Refused">Refused</a>
                <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=BookingStatus&StatusName=Finished">Finished</a>
                <a class="dropdown-item" href="{{ route('salon.bookings')}}?OrderBy=BookingStatus&StatusName=Canceled">Canceled</a>
            </div>
        </div>
    </div>
</div>

@if($bookings->isEmpty())
    <div style="color:green; font-size:30px; text-align:center;">
        <span>No bookings yet!!</span>
    </div>
@else
    @foreach($bookings as $booking)
        <div class="card-footer text-muted row mb-2">
            <div class="col">
                ID: {{ $booking->id }} <br>
                Date: {{ $booking->Date }} <br>
                Name: {{ $booking->UserName }} {{ $booking->UserSurname }} <br>
                Category: {{ $booking->ServiceCategoryName }} <br>
                Service: {{ $booking->ServiceName }} <br>
            </div>
            <div class="col">
                Begin Time: {{ $booking->BeginTime }} <br>
                Finish Time: {{ $booking->FinishTime }} <br>
                Customer: {{ $booking->StaffName }} <br>
                Status: {{ $booking->BookingStatus }} <br>
            </div>
            <div class="col">
                @if($booking->BookingStatus == 'Booked')
                    <form action="{{route('salon.bookings.manage')}}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="BookingID" value="{{ $booking->id }}">
                        <input type="hidden" name="Action" value="Finished">
                        <button class="btn btn-primary" name="submit" type="submit">Mark as finished</button>
                    </form>
                    <form action="{{route('salon.bookings.manage')}}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="BookingID" value="{{ $booking->id }}">
                        <input type="hidden" name="Action" value="Refused">
                        <button class="btn btn-primary" name="submit" type="submit">Refuse</button>
                    </form>
                @elseif($booking->BookingStatus == 'Finished')
                    <span style="color:green;">Finished!!</span>
                @elseif($booking->BookingStatus == 'Refused')
                    <span style="color:red;">Refused!!</span>
                @elseif($booking->BookingStatus == 'Canceled')
                    <span style="color:red;">User Canceled!!</span>
                @endif
            </div>
        </div>
    @endforeach
@endif
@endsection
