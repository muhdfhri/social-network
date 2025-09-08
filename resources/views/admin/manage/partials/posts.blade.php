<div class="overflow-x-auto shadow-sm rounded-lg">
    @if($posts->count() > 0)
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/4">
                        Pengguna
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-2/5">
                        Konten
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/6">
                        Interaksi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/8">
                        Dibuat
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/8">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($posts as $post)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <!-- Kolom Pengguna dengan layout yang diperbaiki -->
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                @if($post->user)
                                    <!-- Avatar dengan ukuran konsisten -->
                                    <div class="flex-shrink-0">
                                        @if($post->user->profile || $post->user->thumbnail)
                                            <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600" 
                                                 src="{{ asset($post->user->profile ? 'storage/' . $post->user->profile : 'storage/' . $post->user->thumbnail) }}" 
                                                 alt="{{ $post->user->first_name }} {{ $post->user->last_name }}"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <!-- Fallback avatar jika gambar gagal load -->
                                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold text-lg border-2 border-gray-200 dark:border-gray-600" style="display: none;">
                                                {{ strtoupper(substr($post->user->first_name, 0, 1)) }}
                                            </div>
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold text-lg border-2 border-gray-200 dark:border-gray-600">
                                                {{ strtoupper(substr($post->user->first_name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Informasi pengguna -->
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                            {{ $post->user->first_name }} {{ $post->user->last_name }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                            {{ $post->user ? '@'.$post->user->username : '' }}
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center space-x-3">
                                        <div class="h-12 w-12 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 italic">
                                            Pengguna tidak ditemukan
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                        
                        <!-- Kolom Konten -->
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-white">
                                <p class="line-clamp-3 leading-relaxed">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                            </div>
                        </td>
                        
                        <!-- Kolom Interaksi -->
                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                    </svg>
                                    {{ $post->likes_count }} Suka
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    {{ $post->comments_count }} Komentar
                                </span>
                            </div>
                        </td>
                        
                        <!-- Kolom Tanggal -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs text-gray-500 dark:text-gray-400" title="{{ $post->created_at->format('d F Y H:i:s') }}">
                                {{ $post->created_at->locale('id')->diffForHumans() }}
                            </div>
                        </td>
                        
                       <!-- Kolom Aksi -->
<td class="px-6 py-4 whitespace-nowrap">
    <div class="flex items-center space-x-2">
        <a href="{{ route('post.show', $post->uuid) }}" 
           class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800 transition-colors duration-150">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Lihat
        </a>

        <!-- Form hapus pakai SweetAlert -->
        <form action="{{ route('admin.manage.posts.delete', $post->id) }}" method="POST" class="inline-block delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 dark:bg-red-900 dark:text-red-200 dark:hover:bg-red-800 transition-colors duration-150">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus
            </button>
        </form>
    </div>
</td>
</tr>
@endforeach
</tbody>
</table>

<!-- Pagination dengan styling yang diperbaiki -->
<div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 rounded-b-lg">
    {{ $posts->appends(['type' => 'posts'])->links() }}
</div>
@else
<!-- Empty state yang lebih menarik -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <div class="p-12 text-center">
        <div class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500 mb-4">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="h-full w-full">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tidak ada postingan</h3>
        <p class="text-gray-500 dark:text-gray-400">Belum ada postingan yang ditemukan dalam sistem.</p>
    </div>
</div>
@endif
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll(".delete-form");
    forms.forEach(form => {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Yakin hapus postingan ini?",
                text: "Tindakan ini tidak bisa dibatalkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e3342f",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

<style>
/* Custom styles untuk line-clamp jika belum tersedia */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
/* Smooth transitions untuk hover effects */
.transition-colors {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
.duration-150 {
    transition-duration: 150ms;
}
/* Responsif untuk mobile */
@media (max-width: 640px) {
    .overflow-x-auto table {
        font-size: 0.75rem;
    }
    .px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .py-4 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
}
</style>
