@extends('layouts.master')
@section('title', 'User Home')
@section('content')
@include('partials.user-menu')

<section class="py-5 bg-light">
    <div class="container">
        <h2 id="HomePageCategories">Main Categories</h2>
        <form action="{{route('user.get.ricerca.categories')}}" method="post" class="">
            <input class="form-control " type="text" name="search" placeholder="Search..">
            <div class="result mb-3">

            </div>
        </form>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-4 col-sm-12 mb-4">
                    <a href="{{ route('user.category.salons', ['category' => $category->ServiceCategoryName]) }}">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{asset('assets')}}/images/ServiceCategoryImages/{{ $category->ImageName }}" alt="ServiceCategoryImage" />
                            <div class="card-body">
                                <h4 class="card-title">{{ $category->ServiceCategoryName }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $(' input[type="text"]').on("keyup input", function() {
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("{{route('user.get.ricerca.categories')}}", {
                    term: inputVal
                }).done(function(data) {
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else {
                resultDropdown.empty();
            }
        });
    });

</script>

@endpush
