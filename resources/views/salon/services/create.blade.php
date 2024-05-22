@extends('layouts.master')

@section('title', 'Add New Service')

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
    <div style="padding-top:50px">
        <form action="{{ route('salon.services.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col" style="padding-left:140px">
                    <label for="ServiceName">Service Name:</label>
                    <input type="text" name="ServiceName" value="{{ old('ServiceName') }}" required>
                    @error('ServiceName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-left:140px">
                    <label for="ShortDescription">Short Description:</label>
                    <input type="text" name="ShortDescription" value="{{ old('ShortDescription') }}" required>
                    @error('ShortDescription')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-left:140px">
                    <label for="Price">Price:</label>
                    <input type="number" name="Price" value="{{ old('Price') }}" required>
                    @error('Price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-left:140px">
                    <label for="TimeDurationHours">Time Duration Hours:</label>
                    <input type="number" name="TimeDurationHours" value="{{ old('TimeDurationHours') }}" required>
                    @error('TimeDurationHours')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-left:140px">
                    <label for="TimeDurationMinutes">Time Duration Minutes:</label>
                    <input type="number" name="TimeDurationMinutes" value="{{ old('TimeDurationMinutes') }}" required>
                    @error('TimeDurationMinutes')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-left:140px">
                    <label for="Category">Category:</label>
                    <select name="Category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->ServiceCategoryName }}</option>
                        @endforeach
                    </select>
                    @error('Category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-left:140px">
                    <label for="fileToUpload">Photo: [Recommended to be 750px X 350px]</label>
                    <input type="file" id="fileToUpload" name="fileToUpload">
                    @error('fileToUpload')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="submit" name="Submit" value="Confirm changes" class="btn btn-dark">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
