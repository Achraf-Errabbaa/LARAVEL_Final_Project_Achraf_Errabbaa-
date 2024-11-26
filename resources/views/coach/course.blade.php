@extends('layouts.app')

@section('content')
    @php
        $categories = ['Programming', 'Design', 'Marketing', 'Business'];
    @endphp

    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#7AB2D3',
                            secondary: '#F5F7F8',
                            accent: '#F4CE14',
                            text: '#45474B',
                        },
                        animation: {
                            'fade-in': 'fadeIn 0.5s ease-out',
                        },
                        keyframes: {
                            fadeIn: {
                                '0%': {
                                    opacity: '0'
                                },
                                '100%': {
                                    opacity: '1'
                                },
                            },
                        },
                    }
                }
            }
        </script>
    </head>

    <div class=" min-h-screen flex flex-col  py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if (Auth::User()->role == 'coach' || Auth::User()->role == 'admin')
                <h1 class="text-4xl font-bold text-center text-primary mb-12 animate-fade-in">Course Management</h1>

                    <div class="flex justify-end">
                        <button id="addNewClassBtn"
                            class="bg-blue-500 text-white font-bold px-6 py-3 rounded-xl hover:bg-primary/80 transition duration-300 w-64 right-0 text-lg">
                            <i class="fas fa-plus-circle mr-2"></i>Create New Course
                        </button>
                    </div>
            @endif
            <!-- Display Courses -->
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold mb-12 text-center text-gray-900">Available Courses</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($courses->reverse() as $course)
                    <div
                        class="bg-white rounded-lg shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                        <div class="relative h-64"> <!-- Increased height for larger image -->
                            <img src="{{ asset('storage/' . $course->file) }}" alt="{{ $course->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent">
                                <span
                                    class="absolute top-3 right-3 bg-gray-500 text-white text-sm font-semibold px-3 py-1 rounded-full">
                                    {{ $course->classes->category ?? 'Uncategorized' }}
                                </span>
                            </div>

                        </div>
                        <div class="relative -mt-10 bg-white z-10 rounded-t-2xl border-t p-6">
                            <h2 class="text-2xl font-bold leading-tight text-gray-900 mb-2">{{ $course->title }}</h2>
                            <p class="text-base text-gray-600">{{ $course->classes->name }}</p>
                        </div>
                        <div class="p-6">
                            <p class="text-base text-gray-700 line-clamp-4">{{ $course->description }}</p>
                        </div>
                        <div class="p-6 border-t">
                            <a href="{{ route('coach.lesson', ['course' => $course->id]) }}"
                                class="block w-full bg-accent hover:bg-accent/90 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                </svg>
                                View Course Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div id="addClassModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-xl w-full">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold ">Create a New Course</h2>
                <button id="closeModalBtn" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('coach.store') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="file" class="block text-sm font-medium text-text mb-2">Course Image:</label>
                    <div id="fileThumbnail"
                        class="w-full h-48 bg-no-repeat bg-secondary bg-cover border-2 border-dashed border-black rounded-xl flex items-center justify-center cursor-pointer hover:bg-primary/10 transition duration-300"
                        onclick="document.getElementById('file').click();">
                        <span class=" text-sm">Choose an image</span>
                    </div>
                    <input type="file" name="file" id="file" class="hidden" required onchange="updateThumbnail(event)">
                </div>
                
                
                <div>
                    <label for="title" class="block text-sm font-medium text-text mb-2">Course Title:</label>
                    <input type="text" name="title" id="title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-text mb-2">Description:</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        required></textarea>
                </div>
                <div>
                    <label for="class_id" class="block text-sm font-medium text-text mb-2">Class:</label>
                    <select name="class_id" id="class_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                        <option value="" disabled selected>Select a class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 px-6 py-3 rounded-xl hover:bg-primary/80 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <i class="fas fa-plus-circle mr-2"></i>Create Course
                </button>
            </form>
        </div>
    </div>

    <script>
        const addClassModal = document.getElementById('addClassModal');
        const addNewClassBtn = document.getElementById('addNewClassBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');

        addNewClassBtn.addEventListener('click', () => {
            addClassModal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            addClassModal.classList.add('hidden');
        });

        // Close modal when clicking outside
        addClassModal.addEventListener('click', (e) => {
            if (e.target === addClassModal) {
                addClassModal.classList.add('hidden');
            }
        });

        function updateThumbnail(event) {
            const file = event.target.files[0];
            const thumbnail = document.getElementById('fileThumbnail');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    thumbnail.style.backgroundImage = `url(${e.target.result})`;
                    thumbnail.innerHTML = '';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
