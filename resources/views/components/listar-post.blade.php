<div>
    @if($posts->count())

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                        <a href="{{ route('posts.show',['post' => $post, 'user' => $post->user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                        </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-600 text-sm text-center font-bold">No hay publicaciones, sigue a alguien para poder ver sus publicaciones</p>

    @endif
</div>