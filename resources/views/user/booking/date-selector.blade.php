@extends('layouts.master')
@section('title', 'Date Selector')
@section('content')
@include('partials.user-menu')
@php
    $today = date("Y-m-d");
    $maxDay = date('Y-m-d', strtotime($today . ' + 10 days'));
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <img src="https://media.istockphoto.com/vectors/black-line-calendar-with-check-mark-icon-isolated-on-white-background-vector-id1226363456?k=6&m=1226363456&s=612x612&w=0&h=zcOS4F8tjbO5be78K4NykoDHHa03tCOkU_5z86-R4yk=" class="img-fluid">
        </div>

        <div class="col-md-5 formDate">
            <span class="MyBB">Choose the day:</span>
            <form method="post" action="{{ route('user.service.view', ['ServicePass' => request()->ServicePass, 'Salonview' => request()->Salonview, 'Categoryview' => request()->Categoryview]) }}">
                @csrf
                <input class="form-control DataStyle" type="date" value="{{ $today }}" min="{{ $today }}" max="{{ $maxDay }}" name="date">
                <div class="MyBB">
                    <button class="btn btn-primary" name="submit" type="submit">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection