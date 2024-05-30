@extends('layouts.app')
@section('content')
<!-- Notification start here -->
@include('layouts.message_notification')
<!-- Notification end here -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body">
                    <div class="messaging-btn-div">
                        <h1>Lets Fun</h1>
                        <div class="margin-top-20">
                            <a href="{{ url('/public-messaging') }}" class="button">Public Chat</a>
                            <a href="{{ url('/public-messaging') }}" class="button">Private Chat</a>
                            <a href="{{ url('/public-messaging') }}" class="button">Group Chat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
