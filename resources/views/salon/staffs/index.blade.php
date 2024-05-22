@extends('layouts.master')

@section('title', 'Manage Staff')

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

<div class="row mb-4">
    <div class="col">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Staff
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($staffs as $staff)
                    <a class="dropdown-item" href="{{ route('salon.staffs')}}?StaffManageName={{$staff->Name}}">{{ $staff->Name }}</a>
                @endforeach
                @if($staffs->isEmpty())
                    <a class="dropdown-item" href="#">No Staff</a>
                @endif
            </div>
        </div>
    </div>
</div>

@if($selectedStaff)
    <form action="{{ route('salon.staffs.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="StaffID" value="{{ $selectedStaff->id }}">

        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Name:</label>
                <input type="text" id="fname" name="Name" value="{{ $selectedStaff->Name }}">
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Surname:</label>
                <input type="text" id="fname" name="Surname" value="{{ $selectedStaff->Surname }}">
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Email:</label>
                <input type="email" id="fname" name="Email" value="{{ $selectedStaff->Email }}">
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Phone Number:</label>
                <input type="text" id="fname" name="Phone" value="{{ $selectedStaff->PhoneNumber }}">
            </div>
        </div>
        <h3 style="text-align:center;">Categories:</h3><br>
        @foreach($categories as $category)
            <div class="row" style="border-top:solid 1px;">
                <div class="col" style="padding-left:140px">
                    <input type="checkbox" id="Categories" name="{{ $category->ServiceCategoryName }}" value="{{ $category->ServiceCategoryName }}"
                    @if(in_array($category->ServiceCategoryName, $staffCategories)) checked @endif>
                    <label for="Categories">{{ $category->ServiceCategoryName }}</label><br>
                </div>
            </div>
        @endforeach
        @if($categories->isEmpty())
            No categories yet.
        @endif
        <div class="row">
            <div class="col" style="padding-left:140px">
                @if($selectedStaff->ImageName)
                    <img src="{{ asset($selectedStaff->ImageName) }}" alt="StaffImages" width="450" height="350">
                @else
                    No Photo set.
                @endif
                <label for="fname">Photo: [Recommended to be 450px X 350px]</label>
                <input type="file" id="fname" name="fileToUpload">
            </div>
        </div>
        <input type="submit" value="Confirm changes" class="btn btn-dark">
    </form>
@else
    <div class="row">
        <div class="col">
            <h1 style="text-align:center;">Select the staff to manage OR</h1><br>
            <h1 style="text-align:center;"><a style="color:blue" href="{{ route('salon.staffs.create') }}">Add a new Staff</a></h1>
        </div>
    </div>
@endif
@endsection
