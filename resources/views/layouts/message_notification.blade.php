
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    Echo.channel(`public-messaging`)
        .listen('PublicMessaging', (e) => {
            toastr.info("You have new message!")
            toastr.options.timeOut = 60; // How long the toast will display without user interaction
            toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
        });
</script>
