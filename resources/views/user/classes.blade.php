@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Your Classes</h1>

        @if($classes->isEmpty())
            <p class="text-gray-500">There are no classes yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($classes as $class)
                    <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $class->name }}</h2>
                            <p class="text-sm text-gray-600">Category: {{ $class->category }}</p>
                            <p class="text-sm text-gray-600">Max Participants: {{ $class->max_participants }}</p>
                        </div>
                        <div class="p-4 bg-gray-50">
                            <button class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium py-2 px-4 rounded">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection