@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white   ">

    <main>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
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


            <div class="mt-20 mb-20 animate-fade-in-up">
    <h3 class="text-3xl font-bold text-gray-900 text-center mb-8 animate-slide-in-up delay-100">Featured Courses</h3>
    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-10 animate-slide-in-up delay-200">
        Explore our most popular courses curated just for you. Discover knowledge that suits your interests and goals.
    </p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4 sm:px-6 lg:px-8">
        @foreach($userClasses as $class)
        <div class="bg-white rounded-lg shadow-md overflow-hidden animate-fade-in-up delay-300">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $class->name }}</h2>
                <p class="text-gray-600 mb-4">{{ $class->description ?? 'No description available' }}</p>
                <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        <span>{{ $class->users()->count() }}/{{ $class->max_participants }} seats</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Schedule information (not provided in original data)</span>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $class->category }}
                </span>
                <div class="flex space-x-2">
                    <a href="{{ route('class.courses', $class->id) }}"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        View Details
                    </a>

                    @if (Auth::User()->role == 'coach' || Auth::User()->role == 'admin')
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
            

            <!-- New About Us Section -->
            <div class="mt-36>
                <h3 class="text-2xl font-bold text-gray-900 ">About Us</h3>
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="lg:w-1/2 space-y-6">
                        <p class="text-xl text-gray-500">
                            We are dedicated to providing high-quality education and empowering learners worldwide.
                        </p>
                        <div class="prose prose-indigo">
                            <p>
                                Our learning platform was founded with the vision of making education accessible to everyone, regardless of their location or background. We believe that knowledge is power, and we strive to create an environment where learners can explore their passions, develop new skills, and achieve their goals.
                            </p>
                            <p>
                                With a team of experienced educators and industry professionals, we curate and create courses that are relevant, engaging, and practical. Our interactive learning experiences are designed to cater to different learning styles and paces, ensuring that every student can succeed.
                            </p>
                        </div>
                        <div class="mt-8">
                            <a href="about.html" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200">
                                Learn More About Us
                            </a>
                        </div>
                    </div>
                    <div class="mt-10 lg:mt-0 lg:w-1/2">
                        <img src="{{ asset('images/vecteezy_school-activity-illustration1_SS0321.jpg') }}" alt="About Us Illustration" class="rounded-lg w-full">
                    </div>
                </div>
            </div>

            <!-- Mission Statement -->
            <div class="mt-20 container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Mission</h2>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0 w-full md:w-96">
                            <img class="w-96 h-80 object-cover rounded-t-lg md:rounded-none md:rounded-l-lg" src="{{ asset('images/learn.jpg') }}" alt="Students collaborating on a project">
                        </div>
                        <div class="p-8">
                            <p class="text-xl text-gray-700 leading-relaxed mb-6">
                                To empower individuals through accessible, high-quality education and foster a global community of lifelong learners.
                            </p>
                            <p class="text-gray-600 mb-4">
                                We believe that education is the cornerstone of progress and personal growth. Our mission is to break down barriers to learning and provide opportunities for everyone, regardless of their background or circumstances.
                            </p>
                            <div class="grid md:grid-cols-2 gap-4 mt-8">
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-700">Accessible Education</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <span class="text-gray-700">Innovative Learning</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-gray-700">Global Community</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                    <span class="text-gray-700">Lifelong Learning</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 px-8 py-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Our Impact</h3>
                        <div class="grid md:grid-cols-3 gap-6 text-center">
                            <div>
                                <p class="text-3xl font-bold text-blue-600">1M+</p>
                                <p class="text-gray-600">Students Enrolled</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-blue-600">100+</p>
                                <p class="text-gray-600">Countries Reached</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-blue-600">500+</p>
                                <p class="text-gray-600">Courses Offered</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Contact Section -->
            <div class="mt-20">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Us</h3>
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-lg text-gray-700 mb-4">
                                Have questions or feedback? We'd love to hear from you! Our support team is available to assist you with any inquiries.
                            </p>
                            <ul class="space-y-2 mb-6">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span>Email: support@learningplatform.com</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    <span>Phone: +1 (555) 123-4567</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Address: 123 Learning St, Education City, 12345</span>
                                </li>
                            </ul>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-indigo-600" aria-label="Facebook">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-indigo-600" aria-label="Twitter">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-indigo-600" aria-label="LinkedIn">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>
                                </a>
                            </div>
                        </div>
                        <div>
                            <form class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                    <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<div class="bg-white">
</div>
@endsection
