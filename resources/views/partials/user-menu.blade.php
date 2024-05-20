<div class="container-fluid">
    <div class="TextDimension">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
            <a class="nav-link" id="Logo" href="{{route('user.index')}}">BeautyCall</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('user.categories')}}">Categories <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('user.salons')}}">Providers</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle navbar-nav" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{route('user.bookings')}}">Bookings</a>
                            <a class="dropdown-item" href="{{route('user.profile')}}">Account informations</a>
                            <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                        </div>
                    </li>
                    <li>
                        <img src="{{auth()->user()->UserImageName ? '/images/DefaultProfileImage.jpeg' :  auth()->user()->UserImageName}}" class="rounded-circle" alt="Profile Image">
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
