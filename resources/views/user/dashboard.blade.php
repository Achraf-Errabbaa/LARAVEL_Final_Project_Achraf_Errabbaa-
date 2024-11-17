<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learning Platform</title>

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

    <!-- Header -->
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Learning Platform</h1>
            <nav class="space-x-6">
                <a href="#" class="hover:text-gray-300">Home</a>
                <a href="#" class="hover:text-gray-300">Courses</a>
                <a href="#" class="hover:text-gray-300">Events</a>
                <a href="#" class="hover:text-gray-300">Profile</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto flex my-8 px-4">

        <!-- Sidebar -->
        <aside class="w-1/4 bg-white p-4 rounded-lg shadow-md mr-6">
            <h2 class="text-xl font-semibold mb-4">Categories</h2>
            <ul class="space-y-3">
                <li><a href="#" class="hover:text-blue-600">Web Development</a></li>
                <li><a href="#" class="hover:text-blue-600">Data Science</a></li>
                <li><a href="#" class="hover:text-blue-600">Design</a></li>
                <li><a href="#" class="hover:text-blue-600">Marketing</a></li>
            </ul>
        </aside>

        <!-- Main Section -->
        <main class="flex-1">
            <h2 class="text-2xl font-semibold mb-6">Featured Courses</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Learn Web Development</h3>
                        <p class="text-sm text-gray-600 mb-4">An in-depth guide to building modern websites and web
                            apps.</p>
                        <a href="#" class="text-blue-600 hover:underline">Enroll Now</a>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Introduction to Data Science</h3>
                        <p class="text-sm text-gray-600 mb-4">Explore data analysis techniques and machine learning
                            concepts.</p>
                        <a href="#" class="text-blue-600 hover:underline">Enroll Now</a>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Graphic Design Essentials</h3>
                        <p class="text-sm text-gray-600 mb-4">Learn the principles of design and create stunning
                            visuals.</p>
                        <a href="#" class="text-blue-600 hover:underline">Enroll Now</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Learning Platform. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
