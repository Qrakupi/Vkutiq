<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/home.css" rel="stylesheet" type="text/css">
        <link href="/css/session.css" rel="stylesheet" type="text/css">
        <link href="/css/navigations.css" rel="stylesheet" type="text/css">
        <link href="/css/profile.css" rel="stylesheet" type="text/css">
        <link href="/css/video.css" rel="stylesheet" type="text/css">
        <link href="/css/search.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


        <script
          src="https://code.jquery.com/jquery-3.2.1.js"
          integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
          crossorigin="anonymous"></script>

    </head>
    <body style="background-color:rgb(220,220,220)">
        <div class="container-fluid">
            <div class="row">
                @include('layout/navigation')
                @yield('content')
            </div>
        </div>
        <script src="/js/main.js"></script>
        <script src="/js/video.js"></script>
        <script src="/js/profile.js"></script>
    </body>
</html>
