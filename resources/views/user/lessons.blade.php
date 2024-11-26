@extends('layouts.app')
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Navigation Tabs -->
    <div class="flex space-x-4 mb-8 border-b">
        <a href="#overview" class="px-6 py-3 text-gray-600 hover:text-gray-900">Overview</a>
        <a href="#curriculum" class="px-6 py-3 text-indigo-600 border-b-2 border-indigo-600 font-medium">Curriculum</a>
        <a href="#instructors" class="px-6 py-3 text-gray-600 hover:text-gray-900">Instructors</a>
        <a href="#reviews" class="px-6 py-3 text-gray-600 hover:text-gray-900">Reviews</a>
    </div>

    <!-- Course Title -->
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Course Curriculum</h1>

    <!-- Lessons List -->
    <div class="space-y-4">
        @foreach($lessons as $index => $lesson)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden lesson" id="lesson-{{ $lesson->id }}">
            <!-- Lesson Header -->
            <div class="bg-white px-6 py-4 flex items-center justify-between cursor-pointer hover:bg-gray-50" 
                 onclick="toggleLesson({{ $lesson->id }})">
                <div class="flex items-center space-x-3">
                    <span class="text-indigo-600">{{ $index + 1 }}.</span>
                    <h3 class="text-lg font-medium text-gray-900">{{ $lesson->title }}</h3>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ $lesson->duration }} min</span>
                    <svg class="w-5 h-5 text-gray-400 transform transition-transform" id="arrow-{{ $lesson->id }}" 
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <!-- Lesson Content (Initially Hidden) -->
            <div class="hidden" id="lesson-content-{{ $lesson->id }}">
                <div class="px-6 py-4 border-t border-gray-200 space-y-4">
                    @if($lesson->image)
                    <div class="relative">
                        <img class="w-full h-48 object-cover rounded-md" src="{{ asset('storage/' . $lesson->image) }}" alt="{{ $lesson->title }}">
                    </div>
                    @endif

                    <p class="text-gray-700">{{ $lesson->description }}</p>

                    <!-- Lesson Resources -->
                    <div class="space-y-2">
                        @if($lesson->video)
                        <!-- Embed the video directly on the page -->
                        <div class="relative">
                            <video controls class="w-full h-auto rounded-md">
                                <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @endif

                        @if($lesson->pdf)
                        <a href="{{ asset('storage/' . $lesson->pdf) }}" 
                           class="flex items-center space-x-3 p-3 rounded-md hover:bg-gray-50" target="_blank">
                            <i class="fas fa-file-pdf text-red-600"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Lesson PDF</p>
                                <p class="text-sm text-gray-500">Study Materials</p>
                            </div>
                        </a>
                        @endif
                    </div>

                    <!-- Admin Actions -->
                    <div class="space-y-3 pt-4 border-t border-gray-200">
                        <form action="{{ route('lesson.destroy', ['course' => $course->id, 'lesson' => $lesson->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center justify-center w-full px-4 py-2 border border-red-300 rounded-md text-red-700 bg-white hover:bg-red-50 transition-colors duration-300">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Delete Lesson
                            </button>
                        </form>

                        <button class="btn-complete flex items-center justify-center w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-300" 
                                data-lesson-id="{{ $lesson->id }}">
                            <i class="fas fa-check-circle mr-2"></i>
                            Mark as Complete
                        </button>

                        @if($index < count($lessons) - 1)
                        <button class="btn-next-lesson flex items-center justify-center w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-300 next-lesson" 
                                id="next-lesson-{{ $lessons[$index + 1]->id }}" disabled>
                            <i class="fas fa-arrow-right mr-2"></i>
                            Next Lesson
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- JavaScript for Lesson Toggle -->
<script>
function toggleLesson(lessonId) {
    const content = document.getElementById(`lesson-content-${lessonId}`);
    const arrow = document.getElementById(`arrow-${lessonId}`);
    
    content.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}
</script>

@endsection
