<x-app-layout>
 @extends('layouts.app')

@section('content')
<div class="bg-white">
    
    

    <div>
        <div class="flex  flex-col md:flex-row items-center justify-between px-6 py-12 ">

            <div class="md:w-1/2 space-y-6">
                <h1 class="text-4xl font-bold text-gray-800">Welcome to Your Learning Journey</h1>
                <h2 class="text-2xl font-medium text-gray-600">Discover, Learn, and Grow with our interactive platform
                    designed to unlock your potential</h2>
                <p class="text-gray-500 leading-relaxed">
                    Our Learning Platform offers a wide range of courses and classes tailored to your interests and
                    goals. Whether you're here to master a new skill, explore fresh topics, or achieve academic success,
                    you're in the right place. Start by exploring our classes and courses, or log in to pick up where
                    you left off. Let’s make learning exciting and impactful together!
                </p>
                <button data-label="Register" class="rainbow-hover">
                    <span class="sp">Start Learning Today!</span>
                </button>
            </div>

            <div class="mt-8 md:mt-0 flex justify-center">
                <img src="{{ asset('images/boys-online.png') }}" alt="Learning Illustration"
                    class="w-full max-w-md md:max-w-lg lg:max-w-xl ">
            </div>
        </div>

        <div>
            <ul class="flex space-x-5 justify-center font-[sans-serif] pt-7">
                <li
                    class="flex items-center justify-center shrink-0 hover:bg-blue-300 bg-[#FFD700] w-[150px] h-[150px] rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500" viewBox="0 0 55.753 55.753">
                        <path
                            d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
                            data-original="#000000" />
                    </svg>
                </li>
                <li
                    class="flex items-center justify-center shrink-0  hover:bg-blue-300  border-2 cursor-pointer text-base font-bold text-black w-[150px] h-[150px] rounded-full">
                    Development
                </li>
                <li
                    class="flex items-center text-center justify-center shrink-0 hover:bg-blue-300  border-2 cursor-pointer text-base font-bold text-[#333] w-[150px] h-[150px] rounded-full">
                    Media
                </li>
                <li
                    class="flex items-center justify-center shrink-0 hover:bg-blue-300  border-2 cursor-pointer text-base font-bold text-[#333] w-[150px] h-[150px] rounded-full">
                    Design
                </li>
                <li
                    class="flex items-center justify-center shrink-0 hover:bg-blue-300  border-2 cursor-pointer text-base font-bold text-[#333] w-[150px] h-[150px] rounded-full">
                    Business
                </li>
                <li
                    class="flex items-center justify-center shrink-0 bg-[#FFD700] hover:bg-blue-300 border-2 cursor-pointer w-[150px] h-[150px] rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-500 rotate-180"
                        viewBox="0 0 55.753 55.753">
                        <path
                            d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
                            data-original="#000000" />
                    </svg>
                </li>
            </ul>
        </div>

        <div class="mt-[50px]">
            <div class="flex flex-col items-center justify-center">
                <h1 class="text-3xl font-bold mb-4">Explore Our Worlds Featured Courses</h1>
                <h3 class="text-lg text-gray-700">Check out the most demanding courses right now</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                @foreach($courses as $course)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="bg-blue-500 text-white px-4 py-2">
                            <h5 class="text-lg font-semibold">{{ $course->title }}</h5>
                        </div>
                        <div>
                            <img class="w-full h-[300px] object-cover"
                                src="{{ asset('storage/' . $course->file) }}" alt="{{ $course->title }}">
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-2">{{ \Str::limit($course->description, 100) }}</p>
                            <p class="text-sm text-gray-500"><strong>Class:</strong> {{ $course->classes->name }}</p>
                            <p class="text-sm text-gray-500"><strong>Category:</strong>
                                {{ $course->category ?? 'Uncategorized' }}</p>
                            <a href="{{ route('course.lessons', $course->id) }}" class="block mt-4">
                                <button class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">
                                    View Course
                                </button>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
                
            </div>
        </div>
    </div>
</div>
@endsection

</x-app-layout>
