@extends('layouts.frontend')

@section('content')
    <div class="container mx-auto flex flex-wrap py-6">


        <section class="flex flex-wrap justify-center">
            @foreach ($posts as $post)
                <article class="w-full md:w-1/3 flex flex-col items-center px-3 mb-6">
                    <div class="bg-white flex flex-col justify-start p-6 h-full">
                        <a href="{{ route('post.details', $post->slug) }}" class="hover:opacity-75">
                            <img src="{{ Storage::disk('public')->url('post/' . $post->image) }}"
                                alt="{{ $post->title }}" class="w-full h-auto">
                        </a>
                        <a href="{{ route('post.details', $post->slug) }}"
                            class="text-blue-700 text-sm font-bold uppercase pb-4">{{ optional($post->categories->first())->name }}</a>
                        <!-- nome da categoria -->
                        <a href="{{ route('post.details', $post->slug) }}"
                            class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
        
                        <!-- nome do autor -->
                        <p href="#" class="text-sm pb-3">
                            Por <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->username }}</a>,
                            Publicado em {{ $post->created_at }}
                        </p>
                        <!-- nome do autor -->
        
                        <p class="pb-6">{{ Str::limit($post->body, 200) }}</p>
        
                        <a href="{{ route('post.details', $post->slug) }}"
                            class="uppercase text-gray-800 hover:text-black mt-auto">Continue Reading <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </section>
        
        

        <div class="pagination container mx-auto flex flex-wrap py-6">
            <a href="{{ $posts->url(1) }}" class="pagination-link{{ $posts->currentPage() === 1 ? ' active' : '' }}">1</a>
            @if ($posts->currentPage() > 3)
                <span class="pagination-dots">...</span>
            @endif
            @for ($page = max(2, $posts->currentPage() - 2); $page <= min($posts->lastPage() - 1, $posts->currentPage() + 2); $page++)
                <a href="{{ $posts->url($page) }}" class="pagination-link{{ $posts->currentPage() === $page ? ' active' : '' }}">{{ $page }}</a>
            @endfor
            @if ($posts->currentPage() < $posts->lastPage() - 2)
                <span class="pagination-dots">...</span>
            @endif
            @if ($posts->lastPage() > 1)
                <a href="{{ $posts->url($posts->lastPage()) }}" class="pagination-link{{ $posts->currentPage() === $posts->lastPage() ? ' active' : '' }}">{{ $posts->lastPage() }}</a>
            @endif
        </div>
        

    </div>
@endsection

<style>
    

    /* Estilos para a paginação */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1rem;
}

.pagination-link {
    display: inline-block;
    padding: 0.5rem;
    margin: 0 0.25rem;
    color: #3182ce;
    text-decoration: none;
    border: 1px solid #3182ce;
    border-radius: 4px;
}

.pagination-link.active {
    background-color: #3182ce;
    color: white;
}

.pagination-dots {
    margin: 0 0.25rem;
    color: #555555;
}

</style>
