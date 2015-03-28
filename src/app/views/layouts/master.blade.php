<!DOCTYPE html>

<html lang="en-US">
    <head>
        <!-- Title -->
        <title>Weebay</title>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/css/styles.css">
    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Weebay</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav right">
                        @if (Auth::check())
                        <li><a href="/">Hello, {{{Auth::user()->first_name}}}</a></li>
                        <li><a href="/auth/logout">Logout</a></li>
                        @else                        
                        <li><a href="/signup">Signup</a></li>
                        <li><a href="/login">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div id="content">
            @yield('content')
        </div>

        <!-- JS -->
        <script type="text/javascript" src="/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/js/jquery.validate.js"></script>
        <script type="text/javascript" src="/js/bootstrap.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
    </body>

</html>
