@extends('layouts.app')

@section('content')
<!-- Notification start here -->
@include('layouts.message_notification')
<!-- Notification end here -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="margin-top-20 margin-bottom-20 channel-header-div">
                <a href="{{ url('/public-messaging') }}" class="button">Public Chat</a>
                <a href="{{ url('/private-messaging') }}" class="button active">Private Chat</a>
                <a href="{{ url('/private-messaging') }}" class="button">Group Chat</a>
            </div>

            <div class="card">
                <!-- {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}} -->

                <div class="card-body">
                    <div class="send-message-div">
                        <h1 class="margin-bottom-20">Private Channel for Messaging</h1>
                        <div class="row">
                            <div class="col">
                                @if(!empty($userArr))
                                <ul class="list-group">
                                    @foreach($userArr as $user)
                                    <li class="list-group-item list-group-item-dark">
                                        {{$user->name}} <b><sup id="{{$user->id}}-status" class="offline">Offline</sup></b>

                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <div class="col">
                                <div class="msg-all-div">
                                    <div class="messaging">
    
                                    </div>
                                    <div class="smd-send-div">
                                        <form action="" id="form" method="POST">
                                            @csrf
                                            <input type="text" required placeholder="Tell me something please...!" name="message">
                                            <input type="button" class="send-message" value="Send">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

<script type="text/javascript">
    Echo.private(`messaging`)
        .listen('PrivateMessaging', (e) => {
            // toastr.info("You have new private message!")
            // toastr.options.timeOut = 60; // How long the toast will display without user interaction
            // toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
            $(".messaging").append("<strong>" + e.data + "</strong><br>");
            console.log(e);
        });

    
        Echo.join('user-status')
        .here((user) => {
            for (let i = 0; i < user.length; i++) {
                    if (senderId != user[i]['id']) {
                        $("#" + user[i]['id'] + "-status").removeClass("offline");
                        $("#" + user[i]['id'] + "-status").addClass("online");
                        $("#" + user[i]['id'] + "-status").text("Online");

                    }
                }
        })
        .joining((user) => {
            $("#" + user.id + "-status").removeClass("offline");
            $("#" + user.id + "-status").addClass("online");
            $("#" + user.id + "-status").text("Online");
        })
        .leaving((user) => {
            $("#" + user.id + "-status").removeClass("online");
            $("#" + user.id + "-status").addClass("offline");
            $("#" + user.id + "-status").text("Offline");
        })
        .listen('UserStatus', (e) => {
            // console.log(e);
        })



    $(".send-message").click(function(e) {
        e.preventDefault();
        let form = $('#form')[0];
        let data = new FormData(form);

        $.ajax({
            url: "{{ URL::to('/private-message-send') }}",
            type: "POST",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,

            success: function(response) {

                if (response.errors) {
                    var errorMsg = '';
                    $.each(response.errors, function(field, errors) {
                        $.each(errors, function(index, error) {
                            errorMsg += error + '<br>';
                        });
                    });
                    // toastr.error({
                    //     message: errorMsg,
                    //     position: 'topRight'
                    // });

                } else {
                    // toastr.success({
                    //     message: response.success,
                    //     position: 'topRight'

                    // });
                }

            },
            error: function(xhr, status, error) {

                // toastr.error({
                //     message: 'An error occurred: ' + error,
                //     position: 'topRight'
                // });
            }

        });

    })
</script>
@endsection