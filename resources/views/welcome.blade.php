<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Event App</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{asset('images/image.jpeg')}}" alt="Aquí la imagen">
                </div>
                <div class="links">
                    <a href="{{ route('organizer') }}">Organizadores</a>
                    <a href="{{ route('category') }}">Categorías</a>
                    <a href="{{ route('event') }}">Eventos</a>
                </div>
            </div>
        </div>
    </body>
</html>
