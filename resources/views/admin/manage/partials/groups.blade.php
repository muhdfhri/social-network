<div class="overflow-x-auto shadow-sm rounded-lg">
    @if($groups->count() > 0)
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/4">
                        Nama Group
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/4">
                        Pembuat
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/6">
                        Anggota
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
                @foreach($groups as $group)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <!-- Kolom Nama Group dengan layout yang diperbaiki -->
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <!-- Logo group dengan ukuran konsisten -->
                                <div class="flex-shrink-0">
                                    @if($group->thumbnail)
                                        <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600" 
                                             src="{{ asset('images/squads/' . basename($group->thumbnail)) }}" 
                                             alt="{{ $group->name }}"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <!-- Fallback logo jika gambar gagal load -->
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-semibold text-lg border-2 border-gray-200 dark:border-gray-600" style="display: none;">
                                            {{ strtoupper(substr($group->name, 0, 1)) }}
                                        </div>
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-semibold text-lg border-2 border-gray-200 dark:border-gray-600">
                                            {{ strtoupper(substr($group->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Informasi group -->
                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                        {{ $group->name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Kolom Pembuat -->
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @if($group->user->profile || $group->user->thumbnail)
                                        <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600" 
                                             src="{{ asset($group->user->profile ? 'storage/' . $group->user->profile : 'storage/' . $group->user->thumbnail) }}" 
                                             alt="{{ $group->user->first_name }} {{ $group->user->last_name }}"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <!-- Fallback avatar jika gambar gagal load -->
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold text-lg border-2 border-gray-200 dark:border-gray-600" style="display: none;">
                                            {{ strtoupper(substr($group->user->first_name, 0, 1)) }}
                                        </div>
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold text-lg border-2 border-gray-200 dark:border-gray-600">
                                            {{ strtoupper(substr($group->user->first_name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Informasi pembuat -->
                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                        {{ $group->user->first_name }} {{ $group->user->last_name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                        {{ '@'.$group->user->username }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Kolom Anggota -->
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-200">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                </svg>
                                {{ number_format($group->members_count) }} Anggota
                            </span>
                        </td>
                        
                        <!-- Kolom Tanggal -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs text-gray-500 dark:text-gray-400" title="{{ $group->created_at->format('d F Y H:i:s') }}">
                                {{ $group->created_at->locale('id')->diffForHumans() }}
                            </div>
                        </td>
                        
                        <!-- Kolom Aksi -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-left space-x-2">
                                <a href="{{ route('squad.show', $group->uuid) }}" 
                                   class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800 transition-colors duration-150">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat
                                </a>
                                <form action="{{ route('admin.groups.delete', $group->id) }}" method="POST" class="inline-block delete-group-form">
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
            {{ $groups->appends(['type' => 'groups'])->links() }}
        </div>
    @else
        <!-- Empty state yang lebih menarik -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="p-12 text-center">
                <div class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-500 mb-4">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="h-full w-full">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tidak ada grup</h3>
                <p class="text-gray-500 dark:text-gray-400">Belum ada grup yang ditemukan dalam sistem.</p>
            </div>
        </div>
    @endif
</div>

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

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const groupForms = document.querySelectorAll(".delete-group-form");
    groupForms.forEach(form => {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Yakin hapus grup ini?",
                text: "Semua data grup, postingan, dan komentar di dalamnya akan dihapus permanen!",
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