@extends('layouts.app')

@section('content')
@php
    $categories = ['Programming', 'Design', 'Marketing', 'Business'];
@endphp

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="bg-gray-50 min-h-screen py-8">
    @if (session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md transition-all duration-500 ease-in-out">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center px-2 mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Class Dashboard</h1>
                <p class="text-lg text-gray-600">View your classes</p>
            </div>
            @if (Auth::User()->role == 'coach' || Auth::User()->role == 'admin')
            <button id="addNewClassBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                Add New Class
            </button>
            @endif
        </div>
        
        <!-- Class Cards -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($classes as $class)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">{{ $class->name }}</h2>
                        <div class="flex flex-col items-start text-sm text-gray-600 mb-6 space-y-4">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                <span class="text-base">{{ $class->users()->count() }}/{{ $class->max_participants }} seats</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-base">Schedule information (not provided in original data)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $class->category }}
                            </span>
                            <a href="{{ route('class.courses', $class->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition duration-150 ease-in-out">
                                View Details
                            </a>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <form action="{{ route('classes.enroll') }}" method="POST">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $class->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    Enroll Now
                                </button>
                            </form>
        
                            @if (Auth::User()->role == 'coach' || Auth::User()->role == 'admin')
                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                                    Delete Class
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Add New Class Modal -->
<div id="addClassModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg  max-w-md w-full">
        <h2 class="text-2xl font-bold mb-4">Add New Class</h2>
        
        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Class Name:</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Maximum Participants:</label>
                <input type="number" name="max_participants" id="max_participants" max="21" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="mb-4">
                <label for="start" class="block text-sm font-medium text-gray-700 mb-1">Date start:</label>
                <input type="datetime-local" id="start" name="start"
                    min="{{ date('Y-m-d\TH:i') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        
            <div class="mb-4">
                <label for="end" class="block text-sm font-medium text-gray-700 mb-1">Date end:</label>
                <input type="datetime-local" id="end" name="end"
                    min="{{ date('Y-m-d\TH:i') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Category:</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($categories as $category)
                        <label class="inline-flex items-center">
                            <input type="radio" name="category" value="{{ $category }}" class="form-radio text-blue-600" required>
                            <span class="ml-2">{{ $category }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                    Create Class
                </button>
            </div>
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