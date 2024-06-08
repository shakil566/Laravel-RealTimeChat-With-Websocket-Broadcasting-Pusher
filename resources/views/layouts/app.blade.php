<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MessagingSoftware') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <style>
        .send-message-div {
            margin: 0px auto;
            text-align: center;
            width: fit-content;
        }

        .messaging-btn-div {
            margin: 0px auto;
            text-align: center;
            width: fit-content;
        }

        .channel-header-div {
            margin: 0px auto;
            text-align: center;
            width: fit-content;
        }

        .channel-header-div a.button.active {
            background-color: #04AA6D;
        }
        a.user {
            color: #000000 !important;
            font-weight: bold;
        }
        .user-list.active {
            background-color: #04AA6D !important;
        }
        .button {
            background-color: #229ca9;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        .margin-top-20 {
            margin-top: 20px
        }

        .margin-bottom-20 {
            margin-bottom: 20px
        }
        .offline{
            color: red;
        }
        .online{
            color: green;
        }
        .msg-all-div {
            background: #dedede;
            border-radius: 10px;
            padding: 10px;
            height: 225px;
            width: -webkit-fill-available;
            overflow:auto;
            overflow-x:hidden;
        }
        .smd-send-div {
            position: absolute;
            bottom: 0px;
        }
        a {
            text-decoration: none !important;
        }
        .display-none {
            display: none !important;
        }
        .message-right {
            text-align: right !important;
            font-weight: bold;
            font-size: 18px;
            line-height: normal;
        }
        .message-left {
            text-align: left !important;
            font-weight: bold;
            font-size: 18px;
            line-height: normal;
        }
        .msg-time {
            font-size: 10px;
            font-weight: normal;
        }
        .right-side {
            width: 65% !important;
        }
        .left-side {
            width: 35% !important;
        }
        button.send-message {
            border-radius: 5px;
            background: #3b73be;
            border-color: #3b73be;
            color: #fff;
        }
    </style>



    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script>
        {!! Vite::content('resources/js/app.js') !!}
    </script>
    <script>
        var senderId = @json(auth()->user()->id ?? null);
        var receiverId;

    </script>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MessagingSoftware') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('logout') }}" role="button"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}<i class="fa fa-sign-out text-danger" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
