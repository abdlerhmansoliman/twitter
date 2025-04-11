<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Tailwind CDN (optional, لو انت مستخدم Vite مش لازم) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']) 

    <title>@yield('title', __('messages.app_name'))</title>
</head>
<body class="min-h-screen text-white" style="background-color: #15202b;">

    {{-- Flash message --}}
    @if (session('status'))
        <div class="bg-green-500 text-white p-3 m-4 rounded shadow">
            {{ session('status') }}
        </div>
    @endif

    {{-- الهيكل العام --}}
    <div class="flex min-h-screen">
        {{-- القائمة الجانبية --}}
        <x-left-menu :user="$user" :unreadMessages="$unreadMessages ?? 0" />

        {{-- محتوى الصفحة --}}
        <div class="flex-grow p-4">
            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>