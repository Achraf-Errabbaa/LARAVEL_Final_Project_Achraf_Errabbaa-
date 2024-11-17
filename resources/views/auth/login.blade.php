<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learning Platform - Login</title>

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
    <div class="relative min-h-screen bg-cover bg-center"
        style="background-image: url('https://img.freepik.com/free-vector/geometric-science-education-background-vector-gradient-blue-digital-remix_53876-125993.jpg?t=st=1731850860~exp=1731854460~hmac=5fc08b827916d00b88232e60a3ee76cf1da59eb513a2fdcbaffdb098041513cc&w=996');">
        <div class="absolute "></div> <!-- Overlay to darken the background -->

        <!-- Content Section -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-6 text-center ">

            <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">

                <!-- Platform Title -->
                <h1 class="text-4xl font-semibold mb-6">Welcome Back to Learning Platform</h1>
                <p class="text-lg mb-8">Please log in to continue your learning journey!</p>

                <!-- Login Form -->
                <form class="space-y-6 " method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-left font-medium">Email</label>
                        <input id="email" name="email" type="email" required
                            class="w-full p-3 mt-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="you@example.com">
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-left font-medium">Password</label>
                        <input id="password" name="password" type="password" required
                            class="w-full p-3 mt-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your password">
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="text-sm text-blue-400">
                        <a href="{{ route('password.request') }}" class="hover:underline">Forgot your password?</a>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Login</button>
                    </div>
                </form>

                <!-- Register Redirect -->
                <p class="mt-6 text-sm text-gray-300">Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Register here</a>.
                </p>

            </div>
        </div>
    </div>

</body>

</html>
