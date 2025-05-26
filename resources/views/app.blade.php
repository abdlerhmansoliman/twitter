<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Ziggy routes for JS -->
    @routes

    <!-- Vite JS/CSS -->
    @vite('resources/js/app.js')

    <!-- Inertia Head -->
    @inertiaHead
</head>
<body
    class="font-sans antialiased w-full flex"
    style="background-color: #15202b;"
>
    <div class="flex-1">
        @inertia
    </div>
</body>
</html>
