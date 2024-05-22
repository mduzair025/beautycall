@php
$admin = session('admin');
@endphp
<div class="container-fluid">
    <div class="TextDimension">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
            <a class="nav-link" id="Logo" href="{{route('salon.index')}}">{{$admin['Name']}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('salon.clients')}}">Clients <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("salon.bookings")}}">Bookings</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle navbar-nav" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            MyCompany
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{route('salon.staffs')}}">Staffs</a>
                            <a class="dropdown-item" href="{{route('salon.manage.opening-time')}}">Opening Times</a>
                            <a class="dropdown-item" href="{{route('salon.services')}}">Services</a>
                            <a class="dropdown-item" href="{{route('salon.information')}}">Salon Informations</a>
                            <a class="dropdown-item" href="{{route('salon.logout')}}">Logout</a>
                        </div>
                    </li>
                    <li>
                        @php
                            $image = $admin['AdministratorImage'] ?? '/assets/images/DefaultProfileImage.jpeg';
                            $imageUrl = (strpos($image, 'https') === 0) ? $image : asset($image);
                        @endphp
                        <img src="{{$imageUrl}}" class="rounded-circle" alt="Profile Image">
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</div>
