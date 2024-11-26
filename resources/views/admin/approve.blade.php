@extends('layouts.app')

@section('content')
@if (session('approve_success') || session('role_success') || session('reject_success'))
    <div id="flash-message" class="fixed top-4 right-4 z-50">
        @if (session('approve_success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                <p class="font-bold">Success</p>
                <p>{{ session('approve_success') }}</p>
            </div>
        @endif

        @if (session('role_success'))
            <div class="mb-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-md">
                <p class="font-bold">Success</p>
                <p>{{ session('role_success') }}</p>
            </div>
        @endif

        @if (session('reject_success'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                <p class="font-bold">Success</p>
                <p>{{ session('reject_success') }}</p>
            </div>
        @endif
    </div>
@endif
<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="p-6 sm:p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Admin Approval</h2>
            <p class="text-gray-500 mb-6">Manage pending user registrations</p>

            <div class="mb-6">
                <label for="search" class="sr-only">Search</label>
                <input type="search" id="search" placeholder="Search by name or email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="space-y-6" id="userList">
                @foreach ($pendingUsers as $user)
                    <div class="bg-white shadow rounded-lg overflow-hidden transition-shadow duration-300 ease-in-out hover:shadow-lg">
                        <div class="p-6 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <form action="{{ route('admin.approve', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-300">
                                        <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.reject', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-300">
                                        <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-between items-center">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ count($pendingUsers) }} Pending {{ Str::plural('User', count($pendingUsers)) }}
                </span>
            </div>
        </div>
    </div>


    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mt-20">
        <div class="p-6 sm:p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">turn user into coach</h2>


            <div class="mb-6">
                <label for="search" class="sr-only">Search</label>
                <input type="search" id="search" placeholder="Search by name or email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="space-y-6" id="userList">
                @foreach ($approvedUsers as $user)
                @if ($user->role !== 'coach')
                    <div class="bg-white shadow rounded-lg overflow-hidden transition-shadow duration-300 ease-in-out hover:shadow-lg">
                        <div class="p-6 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <form action="{{ Route('admin.role', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-300">
                                        <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        turn To Coach
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const userList = document.getElementById('userList');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const userCards = userList.querySelectorAll('div > div');

        userCards.forEach(function(card) {
            const name = card.querySelector('h3').textContent.toLowerCase();
            const email = card.querySelector('p').textContent.toLowerCase();

            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(() => flashMessage.remove(), 500); // Remove from DOM after fade-out
                }, 3000); // 3 seconds before fading out
            }
        });
</script>
@endpush

