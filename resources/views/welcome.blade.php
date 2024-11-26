<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learning Platform - Login & Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* TailwindCSS Custom Styles here */
        </style>
    @endif
</head>

<body class="font-sans bg-gray-50 text-gray-800">

    <!-- Background Image Section -->
    <div class="relative min-h-screen bg-cover bg-center">
        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Overlay to darken the background -->
        <video autoplay muted loop class="absolute w-full h-full object-cover">
            <source src="{{ asset('images/fps.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="relative z-10 flex items-center justify-center min-h-screen px-6 text-center text-white">

            <div class="max-w-md w-full space-y-8">

                <h1 class="text-4xl font-semibold mb-6">Welcome to the Learning Platform</h1>
                <p class="text-lg mb-8">Sign in or create an account to start your learning journey!</p>

                <div class="flex justify-center space-x-6">
                    <a href="{{ route('login') }}"
                        class="inline-block py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Login</a>
                    <a href="{{ route('register') }}"
                        class="inline-block py-3 px-6 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">Register</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
