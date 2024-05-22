@extends('layouts.master')
@section('title', 'Account informations')
@section('content')
@include('partials.user-menu')

<div id="HomePageCategories">@yield('title')</div>
<div class="container-fluid">
    <div class="AccountInfo">
        <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <table class="tableaccount">
                <tr>
                    <td>Name:</td>
                    <td>{{ Auth::user()->Name }}</td>
                    <td><input type="text" name="Name" value="{{ old('Name', Auth::user()->Name) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>{{ Auth::user()->Username }}</td>
                    <td><input type="text" name="Username" value="{{ old('Username', Auth::user()->Username) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td>{{ Auth::user()->Country }}</td>
                    <td><input type="text" name="Country" value="{{ old('Country', Auth::user()->Country) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td>{{ Auth::user()->City }}</td>
                    <td><input type="text" name="City" value="{{ old('City', Auth::user()->City) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>{{ Auth::user()->Address }}</td>
                    <td><input type="text" name="Address" value="{{ old('Address', Auth::user()->Address) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Postal Code:</td>
                    <td>{{ Auth::user()->PostalCode }}</td>
                    <td><input type="text" name="PostalCode" value="{{ old('PostalCode', Auth::user()->PostalCode) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ Auth::user()->Email }}</td>
                    <td><input type="email" name="Email" value="{{ old('Email', Auth::user()->Email) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td>{{ Auth::user()->PhoneNumber }}</td>
                    <td><input type="text" name="PhoneNumber" value="{{ old('PhoneNumber', Auth::user()->PhoneNumber) }}"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Change password:</td>
                    <td></td>
                    <td><input type="password" name="Password"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
                <tr>
                    <td>Profile Image:</td>
                    <td></td>
                    <td><input type="file" name="UserImageName"></td>
                    <td><input type="submit" value="Confirm"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection
