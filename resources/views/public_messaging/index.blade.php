@extends('layouts.app')

@section('content')
<!-- Notification start here -->
@include('layouts.message_notification')
<!-- Notification end here -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="margin-top-20 margin-bottom-20 channel-header-div">
                <a href="{{ url('/public-messaging') }}" class="button active">Public Chat</a>
                <a href="{{ url('/private-messaging') }}" class="button">Private Chat</a>
            </div>

            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body">
                    <div class="send-message-div">

                        <h1 class="margin-bottom-20">Public Channel for Message Send</h1>
                        <form action="" id="form" method="POST">
                            @csrf
                                <label for="message">Message:</label>
                                <input type="text"  class="message" required placeholder="Tell me something please....!" name="message">
                                <br><br>
                                <!-- <input type="button" class="send-message" value="Send"> -->
                                <button type="submit" class="send-message" required placeholder="Tell me something please...!" >Send</button>
                        </form>

                        <br><br>
                        <div class="messaging">

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
    Echo.channel(`messaging`)
        .listen('PublicMessaging', (e) => {
            // toastr.info("You have new public message!")
            // toastr.options.timeOut = 60; // How long the toast will display without user interaction
            // toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
            $(".messaging").append("<strong>" + e.data + "</strong><br>");
            // console.log(e);
        });



    $(".send-message").click(function(e) {
        e.preventDefault();
        let form = $('#form')[0];
        let data = new FormData(form);

        $.ajax({
            url: "{{ URL::to('/public-message-send') }}",
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
