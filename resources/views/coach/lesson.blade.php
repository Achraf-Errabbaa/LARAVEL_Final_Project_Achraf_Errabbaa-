@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    @if (Auth::User()->role== 'coach' || Auth::User()->role== 'admin')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-[#22B8BF] mb-8 text-center">Lessons for "{{ $course->title }}"</h1>

        <!-- Button to open the modal -->
        <div class="text-center mb-8">
            <button id="openModalBtn" class="bg-[#22B8BF] text-white px-6 py-3 rounded-md hover:bg-[#1C9A9F] transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#22B8BF]">
                Add New Lesson
            </button>
        </div>
        @endif

        <!-- Modal -->
        <div id="lessonModal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-3xl">
                <div class="bg-[#22B8BF] text-white px-6 py-4 flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Add New Lesson</h2>
                    <button id="closeModalBtn" class="text-white text-lg">&times;</button>
                </div>
                <form action="{{ route('coach.lesson', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Lesson Title:</label>
                            <input type="text" name="title" id="title" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required>
                        </div>
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (in minutes):</label>
                            <input type="number" name="duration" id="duration" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                        <textarea name="description" id="description" rows="4" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="video" class="block text-sm font-medium text-gray-700 mb-1">Upload Video:</label>
                            <input type="file" name="video" id="video" accept="video/*" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]">
                        </div>
                        <div>
                            <label for="pdf" class="block text-sm font-medium text-gray-700 mb-1">Upload PDF:</label>
                            <input type="file" name="pdf" id="pdf" accept=".pdf" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]">
                        </div>
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Lesson Content:</label>
                        <textarea name="content" id="content" rows="6" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#22B8BF]" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#22B8BF] text-white px-6 py-3 rounded-md hover:bg-[#1C9A9F] transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#22B8BF]">
                        Create Lesson
                    </button>
                </form>
            </div>
        </div>

        <!-- Display existing lessons -->
        
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <h2 class="text-3xl font-bold text-[#22B8BF] mb-6 text-center">Existing Lessons</h2>
            @foreach($lessons as $index => $lesson)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl lesson" id="lesson-{{ $lesson->id }}">
                    <div class="bg-[#22B8BF] text-white px-6 py-4">
                        <h3 class="text-xl font-semibold">{{ $lesson->title }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($lesson->image)
                            <img class="w-full h-48 object-cover rounded-md" src="{{ asset('storage/' . $lesson->image) }}" alt="{{ $lesson->title }}">
                        @endif
                        <p class="text-gray-700">{{ \Str::limit($lesson->description, 100) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span><i class="fas fa-clock mr-2"></i>{{ $lesson->duration }} minutes</span>
                            <span><i class="fas fa-calendar-alt mr-2"></i>{{ $lesson->created_at->format('M d, Y') }}</span>
                        </div>

                        <!-- Buttons to complete the lesson and go to the next lesson -->
                        <div class="flex space-x-2">
                            @if($lesson->video)
                                <a href="{{ asset('storage/' . $lesson->video) }}" class="flex-1 bg-blue-500 text-white text-center py-2 rounded-md hover:bg-blue-600 transition duration-300" target="_blank">
                                    <i class="fas fa-play-circle mr-2"></i>Watch Video
                                </a>
                            @endif
                            @if($lesson->pdf)
                                <a href="{{ asset('storage/' . $lesson->pdf) }}" class="flex-1 bg-red-500 text-white text-center py-2 rounded-md hover:bg-red-600 transition duration-300" target="_blank">
                                    <i class="fas fa-file-pdf mr-2"></i>View PDF
                                </a>
                            @endif
                        </div>
                        
                        <form action="{{ route('lesson.destroy', ['course' => $course->id, 'lesson' => $lesson->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 text-white text-center py-2 rounded-md hover:bg-red-600 transition duration-300">
                                <i class="fas fa-trash-alt mr-2"></i>Delete Lesson
                            </button>
                        </form>
                        <a href="{{ route('course.lessons', ['course' => $course->id, 'lesson' => $lesson->id]) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            View Details
                        </a>

                        <!-- Button to mark lesson as complete -->
                        <button class="btn-complete bg-[#22B8BF] text-white text-center py-2 rounded-md hover:bg-[#1C9A9F] w-full mt-4" data-lesson-id="{{ $lesson->id }}">
                            Mark as Complete
                        </button>

                        <!-- Button to access next lesson (initially hidden) -->
                        @if($index < count($lessons) - 1)
                            <button class="btn-next-lesson bg-green-500 text-white text-center py-2 rounded-md hover:bg-green-600 w-full mt-2 next-lesson" id="next-lesson-{{ $lessons[$index + 1]->id }}" disabled>
                                Go to Next Lesson
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('lessonModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');

    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
@endsection
