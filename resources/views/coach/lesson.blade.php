@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    @if (Auth::User()->role== 'coach' || Auth::User()->role== 'admin')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold  mb-8 text-center">Lessons for <span class="text-red-500">"{{ $course->title }}"</span></h1>

        <!-- Button to open the modal -->
        <div class="text-center mb-8">
            <button id="openModalBtn" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-[#1C9A9F] transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#22B8BF]">
                Add New Lesson
            </button>
        </div>
        @endif

        <!-- Modal -->
        <div id="lessonModal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full h-[800px] max-w-3xl">
                <button id="closeModalBtn" class="text-white text-lg">&times;</button>
                <form action="{{ route('coach.lesson', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl rounded-lg p-4 space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title</label>
                            <input type="text" name="title" id="title" class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out" required>
                        </div>
                        <div class="space-y-2">
                            <label for="duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                            <input type="number" name="duration" id="duration" class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out" required>
                        </div>
                    </div>
                
                    <div class="space-y-1">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out" required></textarea>
                    </div>
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="video" class="block text-sm font-medium text-gray-700">Upload Video</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="video" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-150 ease-in-out">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">MP4, WebM, or Ogg (MAX. 800MB)</p>
                                    </div>
                                    <input id="video" name="video" type="file" accept="video/*" class="hidden" />
                                </label>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="pdf" class="block text-sm font-medium text-gray-700">Upload PDF</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="pdf" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-150 ease-in-out">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PDF (MAX. 10MB)</p>
                                    </div>
                                    <input id="pdf" name="pdf" type="file" accept=".pdf" class="hidden" />
                                </label>
                            </div>
                        </div>
                    </div>
                
                    <div class="space-y-2">
                        <label for="content" class="block text-sm font-medium text-gray-700">Lesson Content</label>
                        <textarea name="content" id="content" rows="6" class="w-full px-4 py-3 h-20 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out" required></textarea>
                    </div>
                
                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                        Create Lesson
                    </button>
                </form>
            </div>
        </div>

        <!-- Display existing lessons -->
        
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <h2 class="text-3xl font-bold  mb-6 text-center">Existing Lessons</h2>
            @foreach($lessons as $index => $lesson)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl lesson" id="lesson-{{ $lesson->id }}">
                    <div class="bg-[#22B8BF] text-white px-6 py-4">
                        <h3 class="text-xl font-semibold">{{ $lesson->title }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @if($lesson->image)
                            <img class="w-full h-48 object-cover rounded-md" src="{{ asset('storage/' . $lesson->image) }}" alt="{{ $lesson->title }}">
                        @endif
                        <p class="text-gray-700"><span class="text-gray-500">Description:</span> {{ \Str::limit($lesson->description, 100) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span><i class="fas fa-clock mr-2"></i>{{ $lesson->duration }} minutes</span>
                            <span><i class="fas fa-calendar-alt mr-2"></i>{{ $lesson->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold"> <span class="text-gray-500">Content:</span> {{ $lesson->content }}</h3>
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
                        <div class="flex items-center justify-center">
                            <a href="{{ route('course.lessons', ['course' => $course->id, 'lesson' => $lesson->id]) }}" 
                               class="bg-[#0D92F4] text-white text-center py-2 px-6 rounded-md hover:bg-[#1C9A9F] w-full max-w-xs mt-4 transition duration-200 ease-in-out">
                                View Details
                            </a>
                        </div>
                        
                        

                        {{-- <!-- Button to mark lesson as complete -->
                        <button class="btn-complete bg-[#22B8BF] text-white text-center py-2 rounded-md hover:bg-[#1C9A9F] w-full mt-4" data-lesson-id="{{ $lesson->id }}">
                            Mark as Complete
                        </button>

                        <!-- Button to access next lesson (initially hidden) -->
                        @if($index < count($lessons) - 1)
                            <button class="btn-next-lesson bg-green-500 text-white text-center py-2 rounded-md hover:bg-green-600 w-full mt-2 next-lesson" id="next-lesson-{{ $lessons[$index + 1]->id }}" disabled>
                                Go to Next Lesson
                            </button>
                        @endif --}}
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
