<!-- resources/views/salon_category.blade.php -->

@extends('layouts.master')
@section('title', 'Register your salon')
@section('content')
<div class="container">
    <h1>@yield('title')</h1>
    <p>Please fill in this form to create your salon.</p>
    <hr>
    <form action="{{ route('salon.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="Name">Name</label>
        <input type="text" name="Name" value="{{ old('Name') }}" required><br>
        @error('Name')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <label for="Country">Country</label>
        <input type="text" name="Country" value="{{ old('Country') }}" required><br>
        @error('Country')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <label for="City">City</label>
        <input type="text" name="City" value="{{ old('City') }}" required><br>
        @error('City')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <label for="Address">Address</label>
        <input type="text" name="Address" value="{{ old('Address') }}" required><br>
        @error('Address')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <label for="PostalCode">PostalCode</label>
        <input type="text" name="PostalCode" value="{{ old('PostalCode') }}" required><br>
        @error('PostalCode')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <label for="Email">Email</label>
        <input type="email" name="Email" value="{{ old('Email') }}" required><br>
        @error('Email')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <label for="PhoneNumber">PhoneNumber</label>
        <input type="text" name="PhoneNumber" value="{{ old('PhoneNumber') }}" required><br>
        @error('PhoneNumber')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <label for="ShortDescription">ShortDescription</label>
        <input type="text" name="ShortDescription" value="{{ old('ShortDescription') }}" required><br>
        @error('ShortDescription')
        <span class="text-danger">{{ $message }}</span><br>
        @enderror

        <p>Put the opening time for your salon</p>
        <table>
            <tr>
                <td>
                    <label for="MondayOpen">Monday</label>
                </td>
                <td>
                    <input type="time" name="MondayOpen" value="{{ old('MondayOpen') }}" required>
                </td>
                <td>
                    <label for="MondayClosing"></label>
                    <input type="time" name="MondayClosing" value="{{ old('MondayClosing') }}" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="TuesdayOpen">Tuesday</label>
                </td>
                <td>
                    <input type="time" name="TuesdayOpen" value="{{ old('TuesdayOpen') }}" required>
                </td>
                <td>
                    <label for="TuesdayClosing"></label>
                    <input type="time" name="TuesdayClosing" value="{{ old('TuesdayClosing') }}" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="WednesdayOpen">Wednesday</label>
                </td>
                <td>
                    <input type="time" name="WednesdayOpen" value="{{ old('WednesdayOpen') }}" required>
                </td>
                <td>
                    <label for="WednesdayClosing"></label>
                    <input type="time" name="WednesdayClosing" value="{{ old('WednesdayClosing') }}" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ThursdayOpen">Thursday</label>
                </td>
                <td>
                    <input type="time" name="ThursdayOpen" value="{{ old('ThursdayOpen') }}" required>
                </td>
                <td>
                    <label for="ThursdayClosing"></label>
                    <input type="time" name="ThursdayClosing" value="{{ old('ThursdayClosing') }}" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="FridayOpen">Friday</label>
                </td>
                <td>
                    <input type="time" name="FridayOpen" value="{{ old('FridayOpen') }}" required>
                </td>
                <td>
                    <label for="FridayClosing"></label>
                    <input type="time" name="FridayClosing" value="{{ old('FridayClosing') }}" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="SaturdayOpen">Saturday</label>
                </td>
                <td>
                    <input type="time" name="SaturdayOpen" value="{{ old('SaturdayOpen') }}" required>
                </td>
                <td>
                    <label for="SaturdayClosing"></label>
                    <input type="time" name="SaturdayClosing" value="{{ old('SaturdayClosing') }}" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="SundayOpen">Sunday</label>
                </td>
                <td>
                    <input type="time" name="SundayOpen" value="{{ old('SundayOpen') }}" required>
                </td>
                <td>
                    <label for="SundayClosing"></label>
                    <input type="time" name="SundayClosing" value="{{ old('SundayClosing') }}" required><br>
                </td>
            </tr>
        </table>
        <button type="submit" name="submit">Register as administrator</button>
    </form>
</div>
@endsection
