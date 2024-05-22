@extends('layouts.master')

@section('title', 'Manage Services')

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
    <div class="row">
        <div class="col">
            <a href="{{ route('salon.services.create') }}" style="font-size:30px; color:blue; background-color: #fff;"> ..Add a new Service..</a>
        </div>
    </div>
    @forelse ($services as $service)
        <div style="padding-top:50px">
            <form action="{{ route('salon.services.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ServiceID" value="{{ $service->ServiceId }}">
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        <label for="ServiceName">Service Name:</label>
                        <input type="text" name="ServiceName" value="{{ $service->ServiceName }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        <label for="ShortDescription">Short Description:</label>
                        <input type="text" name="ShortDescription" value="{{ $service->ShortDescription }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        <label for="Price">Price:</label>
                        <input type="number" name="Price" value="{{ $service->Price }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        <label for="TimeDurationHours">Time Duration Hours:</label>
                        <input type="number" name="TimeDurationHours" value="{{ $service->TimeDurationHours }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        <label for="TimeDurationMinutes">Time Duration Minutes:</label>
                        <input type="number" name="TimeDurationMinutes" value="{{ $service->TimeDurationMinutes }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        <span style="font-size:30px; color:blue;">Category: {{ $service->ServiceCategoryName }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        @foreach (DB::table('service_images')->where('ServiceID', $service->ServiceId)->get() as $image)
                            @php
                                $img = $image->ImageName ?? '/assets/images/DefaultProfileImage.jpeg';
                                $imageUrl = (strpos($img, 'https') === 0) ? $img : asset($img);
                            @endphp
                            <img src="{{ $imageUrl }}" alt="Service Image" width="460" height="350">
                            <a href="{{ route('salon.services.cancel-image')}}?ServiceImageID={{$image->id}}&ImageName={{$image->ImageName}}" style="font-size:40px">Cancel</a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="padding-left:140px">
                        <label for="fileToUpload">Photo: [Recommended to be 750px  X 350px ]</label>
                        <input type="file" id="fileToUpload" name="fileToUpload">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" name="Submit" value="Confirm changes">
                    </div>
                </div>
            </form>
        </div>
    @empty
        <div class="row">
            <div class="col">
                <h1 style="text-align:center; font-size:30px;">There are no services, add some.</h1><br>
            </div>
        </div>
    @endforelse
</div>
@endsection
