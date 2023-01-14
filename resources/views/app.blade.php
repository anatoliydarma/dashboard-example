<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <title inertia>{{ config('app.name') }}</title>

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
