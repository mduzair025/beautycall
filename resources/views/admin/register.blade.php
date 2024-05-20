@extends('layouts.master')
@section('title', 'Admin Register')

@section('content')
<div class="container">
    <form action="{{ route('admin.register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h1>@yield('title')</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="AdministratorName">Name</label>
        <input type="text" name="AdministratorName" value="{{ old('AdministratorName') }}" required><br>

        <label for="AdministratorSurname">Surname</label>
        <input type="text" name="AdministratorSurname" value="{{ old('AdministratorSurname') }}" required><br>

        <label for="Username">Username</label>
        <input type="text" name="Username" value="{{ old('Username') }}" required><br>

        <label for="Password">Password</label>
        <input type="password" name="Password" required><br>

        <label for="Country">Country</label>
        <input type="text" name="Country" value="{{ old('Country') }}" required><br>

        <label for="City">City</label>
        <input type="text" name="City" value="{{ old('City') }}" required><br>

        <label for="Address">Address</label>
        <input type="text" name="Address" value="{{ old('Address') }}" required><br>

        <label for="PostalCode">PostalCode</label>
        <input type="text" name="PostalCode" value="{{ old('PostalCode') }}" required><br>

        <label for="Email">Email</label>
        <input type="email" name="Email" value="{{ old('Email') }}" required><br>

        <label for="PhoneNumber">PhoneNumber</label>
        <input type="text" name="PhoneNumber" value="{{ old('PhoneNumber') }}" required><br>

        <label for="ProfileImage">Profile image:</label>
        <input type="file" name="ProfileImage" required id="ProfileImage"><br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <hr>
        <button type="submit" class="registerbtn" name="submit">Register as administrator</button>
    </form>
</div>
@endsection
