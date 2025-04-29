<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Insphony') }}</title>
        <meta http-equiv="refresh" content="0;url={{ route('home') }}">
    </head>
    <body>
        <p>Redirecting to homepage...</p>
    </body>
</html>