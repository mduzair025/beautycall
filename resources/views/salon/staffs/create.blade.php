@extends('layouts.master')

@section('title', 'Add Staff')

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
<section class="container">
    <form action="{{ route('salon.staffs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="StaffID">
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Name:</label>
                <input type="text" id="fname" name="Name" required>
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Surname:</label>
                <input type="text" id="fname" name="Surname" required>
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Email:</label>
                <input type="email" id="fname" name="Email" required>
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Phone Number:</label>
                <input type="text" id="fname" name="Phone" required>
            </div>
        </div>
        <h3 style="text-align:center;">Categories:</h3><br>
        @if($categories->isEmpty())
        <p style="text-align:center;">No categories yet.</p>
        @else
        @foreach($categories as $category)
        <div class="row" style="border-top:solid 1px;">
            <div class="col" style="padding-left:140px">
                <input type="checkbox" id="Categories" name="{{ $category->ServiceCategoryName }}" value="{{ $category->ServiceCategoryName }}">
                <label for="Categories">{{ $category->ServiceCategoryName }}</label><br>
            </div>
        </div>
        @endforeach
        @endif
        <div class="row">
            <div class="col" style="padding-left:140px">
                <label for="fname">Photo: [Recommended to be 450px X 350px]</label>
                <input type="file" id="fname" name="fileToUpload">
            </div>
        </div>
        <input type="submit" name="Submit" value="Confirm" class="btn btn-dark">
    </form>
</section>
@endsection
