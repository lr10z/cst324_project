<!DOCTYPE html>

<html lang="en-US">
    <head>
        <!-- Title -->
        <title>Weebay</title>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Monofett">
        <link rel="stylesheet" type="text/css" href="/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/css/styles.css">
    </head>

    <body>
        <!-- Main Content -->
        <div class="container auth">
            <a href="/"><h1>Weebay</h1></a>
            <div id="content" class="jumbotron">
                @yield('content')
            </div>
        </div>

        <!-- JS -->
        <script type="text/javascript" src="/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/js/jquery.validate.js"></script>
        <script type="text/javascript" src="/js/validation.js"></script>
    </body>
</html>
