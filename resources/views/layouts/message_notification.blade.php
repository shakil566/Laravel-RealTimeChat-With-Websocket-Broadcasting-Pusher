<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    Echo.channel(`messaging`)
        .listen('PublicMessaging', (e) => {
            toastr.info("You have new public message!")
            toastr.options.timeOut = 60; // How long the toast will display without user interaction
            toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
        });

    Echo.private(`messaging`)
        .listen('PrivateMessaging', (data) => {
            if ((senderId == data.messageData.receiver_id)) {
                // console.log(data);
                toastr.info("You have new private message!")
                toastr.options.timeOut = 60; // How long the toast will display without user interaction
                toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
            }
        });

</script>