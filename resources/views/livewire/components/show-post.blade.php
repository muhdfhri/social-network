@php
    $path = parse_url(url()->current())['path'];
    $uuid = substr($path, strrpos($path, '/') + 1);
    $post = App\Models\Post::where('uuid', $uuid)->first();
@endphp
<div class="flex flex-col items-center">
    <script>
        function openModal(title) {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
            document.getElementById('modal-title').innerHTML = title;
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('flex');
            document.getElementById('modal').classList.add('hidden');
        }
        
        function openCommentModal(commentId) {
            document.getElementById('comment-modal-' + commentId).classList.remove('hidden');
            document.getElementById('comment-modal-' + commentId).classList.add('flex');
        }

        function closeCommentModal(commentId) {
            document.getElementById('comment-modal-' + commentId).classList.remove('flex');
            document.getElementById('comment-modal-' + commentId).classList.add('hidden');
        }
    </script>
    <div id="modal"
        class=" hidden absolute z-10 center-absolute w-1/4 bg-red-100 border-t-8 border-red-600 rounded-b-lg px-4 py-4 flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
        <div class="flex flex-col justify-center items-center">
            <img src="{{ asset('images/website/trash_bin.gif') }}" alt="" width="100px">
            <h2 class="text-lg font-bold mt-2 text-center">Are you sure to delete <span id="modal-title"></span> ?</h2>
            <div class="flex justify-between gap-6 mt-2">
                <a href="{{ route('post.delete', $uuid, 'delete') }}"
                    class="bg-red-600 active:bg-red-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                    type="button">
                    Delete
                </a>
                <button
                    class="bg-gray-600 active:bg-gray-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                    type="button" onclick="closeModal()">
                    Cancle
                </button>
            </div>
        </div>
    </div>

    <div class="w-3/4 max-w-md bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 p-6 mt-2 mb-2">
        <div style="background-image: url({{ asset('images/thumbnails/' . $post->thumbnail) }}); background-size: cover; background-position: center; background-repeat: no-repeat;"
            class="min-h-xs flex items-center justify-center rounded-lg">
            <div class="glass-morphic min-w-xl text-center">
                <h1 class="text-3xl font-bold text-white">{{ $post->title }}
                </h1>
            </div>
        </div>
        <div class="mt-4 flex justify-between items-start text-gray-700 dark:text-gray-100">
            <div class="flex">
                <div>
                    <img src="{{ asset('images/profiles/' . $post->user->profile) }}" alt="Avatar"
                        class="w-12 h-12 rounded-full mr-4">
                </div>
                <div>
                    <span class="text-sm font-bold">By <a
                            href="{{ route('profile.show', $post->user->username) }}">{{ $post->user->username }}</a></span><br>
                    <span class="text-sm font-bold">{{ $post->created_at->locale('id')->diffForHumans() }}</span>
                </div>
            </div>
            @if(auth()->check() && (auth()->user()->id === $post->user_id || auth()->user()->role === 'admin'))
            <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-3">
                <!-- Edit Button -->
                <a href="{{ route('post.edit', $post->uuid) }}" 
                   class="flex items-center px-3 py-1.5 text-sm bg-blue-50 hover:bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 dark:text-blue-300 rounded-md transition-colors duration-200 font-medium"
                   title="Edit Post">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit</span>
                </a>
                
                <!-- Delete Button -->
                <button onclick="openModal('{{ $post->title }}')" 
                        class="flex items-center px-3 py-1.5 text-sm bg-red-50 hover:bg-red-100 text-red-700 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-300 rounded-md transition-colors duration-200"
                        title="Hapus Postingan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </div>
            @endif
        </div>

        <div class="mt-4 dark:text-white">
            {!! $post->content !!}
        </div>

        @php
            $post_media = App\Models\PostMedia::where('post_id', $post->id)->first();
        @endphp
        @if ($post_media && $post_media->file_type == 'image')
            @php
                $medias = json_decode($post_media->file);
            @endphp
            <div class="mt-4 p-4 rounded-lg text-gray-700 dark:text-gray-100 dark:bg-gray-900">
                <div class="m-4 flex flex-row justify-between">
                    @foreach ($medias as $media)
                        <img src="{{ asset('images/posts/' . $media) }}" alt="post image" class="rounded-lg"
                            width="20%">
                    @endforeach
                </div>
            </div>
        @endif


        <hr class="mt-4 border-2" />
        <div class="mt-4 bg-blue-100 dark:bg-gray-700 p-4 rounded-md">
            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">Komentar</h2>

            <div class="mt-4">
                <form method="POST" action="{{ route('post.comment', $post->id, 'comment') }}">
                    @csrf
                    @if (auth()->user()->banned_to > now('Asia/Yangon'))
                        <div
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg">
                            Anda tidak dapat memberikan komentar karena akun Anda terlarang.
                        </div>
                    @else
                        <label class="w-full text-sm mt-4">
                            <div class="relative text-gray-500 focus-within:text-purple-600">
                                <input type="text" name="comment" id="comment"
                                    class="block w-full  mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                    placeholder="Tulis komentarmu" />

                                <button type="submit"
                                    class="w-24 absolute inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">Kirim</button>
                            </div>
                        </label>
                    @endif
                </form>
            </div>

            <div class="mt-4">
                @php
                    $comments = App\Models\Comment::with('post')->get('*');
                @endphp
                @forelse ($comments as $comment)
                    @if ($comment->post_id == $post->id)
                        <div
                            class="mt-4 p-4 rounded-lg flex flex-col text-gray-700 dark:text-gray-100 bg-gray-100 dark:bg-gray-900">

                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-start space-x-3">
                                    <img src="{{ asset('images/profiles/' . $comment->user->profile) }}" 
                                         alt="Avatar"
                                         class="w-10 h-10 rounded-full flex-shrink-0 mt-1">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('profile.show', $comment->user->username) }}" 
                                               class="text-sm font-semibold text-gray-900 dark:text-white hover:underline truncate">
                                                {{ '@' . $comment->user->username }}
                                            </a>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $comment->created_at->locale('id')->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                @if(auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->id === $post->user_id || auth()->user()->role === 'admin'))
                                <div class="relative flex items-center space-x-1">
                                    <button type="button" 
                                            class="flex items-center text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-400 px-2 py-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-sm"
                                            onclick="openCommentModal('{{ $comment->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-red-600 dark:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Hapus Komentar</span>
                                    </button>
                                    
                                    <!-- Modal Konfirmasi Hapus Komentar -->
                                    <div id="comment-modal-{{ $comment->id }}" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
                                        <div class="absolute z-10 center-absolute w-1/4 bg-red-100 border-t-8 border-red-600 rounded-b-lg px-4 py-4 flex-col justify-around shadow-md dark:bg-white text-gray-700 dark:text-gray-700">
                                            <div class="flex flex-col justify-center items-center">
                                                <img src="{{ asset('images/website/trash_bin.gif') }}" alt="" width="100px">
                                                <h2 class="text-lg font-bold mt-2 text-center">Apakah Anda yakin ingin menghapus komentar ini?</h2>
                                                <div class="flex justify-between gap-6 mt-4">
                                                    <button onclick="document.getElementById('delete-comment-{{ $comment->id }}').submit();"
                                                        class="bg-red-600 active:bg-red-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                                                        type="button">
                                                        Hapus
                                                    </button>
                                                    <button
                                                        class="bg-gray-600 active:bg-gray-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                                                        type="button" onclick="closeCommentModal('{{ $comment->id }}')">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <form id="delete-comment-{{ $comment->id }}" method="POST" action="{{ route('comment.delete', $comment->id) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                                @endif
                            </div>
                            <div class="mt-2 p-4 rounded-lg border dark:text-gray-100 dark:bg-gray-800">
                                <p class="whitespace-pre-line">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endif

                @empty
                    <p> Belum ada komentar</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
