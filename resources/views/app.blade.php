<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hiring</title>
        @vite('resources/css/app.scss')
       
    </head>
    <body class="bg-primary">
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>

<script>
    window.user = @json(auth()->user());
</script>