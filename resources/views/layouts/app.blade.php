<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Blog') }}
        @hasSection('title')
            - @yield('title')
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-full h-full">
    @include('partials.header')
    <main class="flex-1">
        @yield('content')
    </main>
    @include('partials.footer')
</body>

</html>
