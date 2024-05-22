@extends('layouts.master')

@section('title', 'Manage Opening Time')

@section('content')
@include('partials.salon-menu')

<style>
input {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 3px solid #ccc;
    -webkit-transition: 0.5s;
    transition: 0.5s;
    outline: none;
}
input:focus {
    border: 3px solid #555;
}
</style>

<div class="container-fluid">
    @if($openingTimes)
        <div class="card-footer text-muted">
            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                @php
                    $dayValue = $openingTimes->$day;
                @endphp
                <div style="text-align:center;">
                    {{ $day }}: 
                    @if($dayValue && $dayValue != '-')
                        {{ $dayValue }}
                    @else
                        <span style="color:red;">Closed</span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('salon.manage.opening-time.update') }}" method="POST">
        @csrf
        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
            @php
                $dayValue = $openingTimes->$day;
                $dayOpen = $dayValue ? explode('-', $dayValue)[0] : '';
                $dayClose = $dayValue ? explode('-', $dayValue)[1] : '';
            @endphp
            <div class="row">
                <div class="col" style="font-size: 30px;">{{ $day }}</div>
                <div class="col">
                    <input type="time" name="{{ $day }}Open" value="{{ $dayOpen }}">
                </div>
                <div class="col" style="text-align: center;">-</div>
                <div class="col">
                    <input type="time" name="{{ $day }}Closing" value="{{ $dayClose }}">
                </div>
                <div class="col">
                    Closed all day: <input type="checkbox" name="{{ $day }}AllDay">
                </div>
            </div>
        @endforeach
        <input type="submit" name="submit" value="Modify" class="btn btn-dark">
    </form>
</div>
@endsection
