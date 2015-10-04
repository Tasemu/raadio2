<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="/public/css/app.css">
        <script src="/public/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="site-header">
            <div class="container">
                <div class="site-header--logo">
                    <h1 class="logo"><a href="/public"><img src="/public/images/logo.svg" width="30"></a></h1>
                </div>
                <ul class="site-header--main-nav">
                    <li><a class="site-header--nav-item" href="{{ route('home') }}">Home</a></li>
                    @if ($user)
                    <li><a href="{{ route('tracks.create') }}" class="site-header--nav-item">Upload a track</a></li>
                    <li><a href="{{ route('playlists.create') }}" class="site-header--nav-item">Create a playlist</a></li>
                    @endif
                </ul>
                <div class="site-header--user-info">
                    @if ($user)
                    <div class="site-header--user-profile-menu">
                        <img src="http://www.gravatar.com/avatar/{{ md5( strtolower( trim( $user->email ) ) ) }}?s=44" alt="{{ $user->name }}">
                        <ul>
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    @else
                    <a class="site-header--nav-item" href="/public/auth/login">Log in</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Add your site or application content here -->
        <div class="container" style="padding-top:25px;padding-bottom:25px">
            @if(session('status'))
            <div class="status-notification">
                <p>{{ session('status') }}</p>
            </div>
            @endif
            @yield('content')
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="/public/js/vendor/underscore.js"></script>
        <script src="/public/js/vendor/howler.core.js"></script>

        <script src="/public/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
