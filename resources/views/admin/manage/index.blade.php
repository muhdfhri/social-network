@extends('layouts.app')

@section('content')
<div class="container px-6 mx-auto">
    <div class="flex justify-between items-center my-6">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Kelola Postingan
        </h2>
    </div>

    <!-- Tabs -->
    <div class="mb-6">
        <div class="flex border-b border-gray-200 dark:border-gray-700">
            <a href="{{ route('admin.manage', ['type' => 'posts']) }}" 
               class="py-2 px-4 text-center border-b-2 font-medium text-sm {{ $activeTab === 'posts' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Kelola Post
            </a>
            <a href="{{ route('admin.manage', ['type' => 'groups']) }}" 
               class="py-2 px-4 text-center border-b-2 font-medium text-sm {{ $activeTab === 'groups' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Kelola Group
            </a>
            <a href="{{ route('admin.manage', ['type' => 'channels']) }}" 
               class="py-2 px-4 text-center border-b-2 font-medium text-sm {{ $activeTab === 'channels' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Kelola Saluran
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
        @if($activeTab === 'posts')
            @include('admin.manage.partials.posts')
        @elseif($activeTab === 'groups')
            @include('admin.manage.partials.groups')
        @elseif($activeTab === 'channels')
            @include('admin.manage.partials.channels')
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mt-3">Konfirmasi Hapus</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 dark:text-gray-300">Apakah Anda yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Ya, Hapus
                </button>
                <button onclick="closeModal()" class="ml-3 px-4 py-2 bg-gray-200 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let deleteUrl = '';
    
    function showDeleteModal(url) {
        deleteUrl = url;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    
    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (deleteUrl) {
            window.location.href = deleteUrl;
        }
    });
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');n        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endpush
@endsection
