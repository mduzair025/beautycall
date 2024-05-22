@extends('layouts.master')
@section('title', 'User Bookings')
@section('content')
@include('partials.user-menu')
<div class="container-fluid">
    @foreach($bookings as $row)
        @if($row->deleted == null)
            <div class="row SalonRow">
                <div class="col-sm-7">
                    ID: {{ $row->BookingID }}<br>
                    Date: {{ $row->Date }}<br>
                    Begin Time: {{ $row->BeginTime }}<br>
                    Finish Time: {{ $row->FinishTime }}<br>
                    Salon Name: {{ $row->SalonName }}<br>
                    Service Name: {{ $row->ServiceName }}<br>
                    Costumer: {{ $row->StaffName }}<br>
                </div>

                <div class="col-sm-5">
                    @if($row->BookingStatus == "Booked")
                        <div class="row">
                            <div class="col-sm">
                                <form method="post" action="{{route('user.bookings.cancel', $row->BookingID)}}">
                                    @csrf
                                    <button class="btn btn-primary" name="submit" type="submit">
                                        Require cancellation
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($row->BookingStatus == "Finished" && $row->BookingRatingID == null)
                        <div class="row">
                            <div class="col-sm-3">Give a rating:</div>
                            <div class="col-sm-1">
                                <form method="post" action="{{ route('user.bookings.give-reveiw') }}">
                                    @csrf
                                    <div class="rateYo"></div>

                                    <input class="rating" type="hidden" value="" name="Rate">
                                    <input type="hidden" value="{{ $row->ServiceProviderID }}" name="ServiceProviderID">
                                    <input type="hidden" value="{{ $row->BookingID }}" name="BookingID">
                                    <input type="hidden" value="{{ auth()->id() }}" name="UserID">
                                    <button class="btn btn-primary" name="submit" type="submit">
                                        Confirm
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($row->BookingStatus == "Finished" && $row->BookingRatingID != null)
                        <div class="row">
                            <div class="col-sm-3">Rating:</div>
                            <div class="col-sm-1">
                                <div class="rateYo1" data-rateyo-rating="{{ $row->BookingRatingNumber }}"></div>
                            </div>
                        </div>
                    @endif

                    @if($row->BookingStatus == "Refused")
                        <div class="row">
                            <div class="col-sm-3">Status:</div>
                            <div class="col-sm-1">
                                <span style="color:red">Refused</span>
                            </div>
                        </div>
                    @endif

                    @if($row->BookingStatus == "Canceled")
                        <div class="row">
                            <div class="col-sm-3">Status:</div>
                            <div class="col-sm-1">
                                <span style="color:red">Canceled</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
</div>

@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/jquery.rateyo.min.css')}}" />
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    $(function() {
        $(".rateYo").rateYo({
            fullStar: true,
            onSet: function(rating, rateYoInstance) {
                $(".rating").val(rating);
            }
        });

        $(".rateYo1").rateYo({
            readOnly: true,
            fullStar: true,
            onSet: function(rating, rateYoInstance) {
                $(".rating1").val(rating);
            }
        });
    });
</script>
@endpush
