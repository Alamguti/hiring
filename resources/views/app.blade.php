<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hiring</title>
    @vite('resources/css/app.scss')
</head>

<body class="bg-primary">
    <div class="container">
        <div class="row">

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="mt-3 btn btn-danger" type="submit">
                    {{ __('Cerrar sesión') }}
                </button>
            </form>

        </div>
    </div>
    <div id="laravel-app"></div>

    @vite('resources/js/app.js')
</body>

</html>
<script>
    window.user = @json(auth()->user());
</script>
