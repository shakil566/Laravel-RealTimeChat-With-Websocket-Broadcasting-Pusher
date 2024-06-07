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
                                    <li class="list-group-item list-group-item-dark user-list act-{{ $user->id }}">
                                        <a href="#" class="user" data-id="{{ $user->id }}">{{$user->name}} <b><sup id="{{$user->id}}-status" class="offline">Offline</sup></b></a>

                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <div class="col">
                                <div class="message-intro">
                                    <span>
                                        Lets messaging?
                                    </span>
                                </div>
                                <div class="msg-all-div">
                                    <div class="messaging">

                                    </div>
                                    <div class="smd-send-div">
                                        <form action="" id="form" method="POST">
                                            @csrf
                                            <input type="hidden" name="receiver_id" class="receiver">
                                            <input type="text" class="message" required placeholder="Tell me something please...!" name="message">
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


<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->

<script type="text/javascript">
    Echo.private(`messaging`)
        .listen('PrivateMessaging', (data) => {

            if (senderId == data.messageData.receiver_id && receiverId == data.messageData.sender_id) {

                let message = data.messageData.message;
                let messageTime = new Date(data.messageData.created_at);
                $(".messaging").append("<div class='message-left'><span class='msg'>" + data.messageData.message + "</span><br><span class='msg-time'>" + messageTime.toLocaleString() + "</span></div>");

            }
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

            beforeSend: function() {
                $(".send-message").hide();
            },

            success: function(response) {
                $(".send-message").show();
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
                    let message = response.data.message;
                    let messageTime = new Date(response.data.created_at);
                    
                    $(".messaging").append("<div class='message-right'><span class='msg'>" + message + "</span><br><span class='msg-time'>" + messageTime.toLocaleString() + "</span></div>");
                    // $(".messaging").append("<div class='messag-right'>" + message + "<span class='msg-time'>" + messageTime + "</span></div>");
                    $(".message").val('');
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

    $(".msg-all-div").hide();

    $(".user").click(function(e) {
        e.preventDefault();

        let receiver_id = $(this).data('id');
        receiverId = receiver_id;
        $(".receiver").val(receiver_id);
        $(".message").val('');
        $(".messaging").html('');
        $(".message-intro").hide();
        $(".msg-all-div").show();
        $(".user-list").removeClass("active");
        $(".act-" + receiver_id).addClass("active");

        $.ajax({
            url: "{{ URL::to('/message-body') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_id: receiver_id
            },
            cache: false,
            dataType: "JSON",
            processData: false,
            contentType: false,

            beforeSend: function() {
            },

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

                    $(".message").val('');
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