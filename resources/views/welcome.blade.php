<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Laravel</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app"></div>
        <div class="container">
            <articles></articles>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>