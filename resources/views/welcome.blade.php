@extends('layouts.frontend')

@section('content')
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @foreach ($posts as $post)
                <article class="flex flex-col shadow my-4">
                    <!-- Article Image -->
                    <a href="{{ route('post.details', $post->slug) }}" class="hover:opacity-75">
                        {{-- <img src="https://source.unsplash.com/collection/1346951/1000x500?sig=1"> --}}
                        <img src="{{ Storage::disk('public')->url('post/' . $post->image) }}" alt="{{ $post->title }}">
                    </a>

                    <div class="bg-white flex flex-col justify-start p-6">
                        <!-- nome da categoria -->
                        <a href="{{ route('post.details', $post->slug) }}" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
                        <!-- nome da categoria -->
                        <a href="{{ route('post.details', $post->slug) }}"
                            class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>


                        <!-- nome do autor -->
                        <p href="#" class="text-sm pb-3">
                            Por <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->username }}</a>,
                            Publicado em {{ $post->created_at }}
                        </p>
                        <!-- nome do autor -->

                        <a class="pb-6">{{ $post->body }}</a>

                        <a href="{{ route('post.details', $post->slug) }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach

            <!-- Pagination -->
            <div class="flex items-center py-8">
                <a href="#"
                    class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
                <a href="#"
                    class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
                <a href="#"
                    class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next
                    <i class="fas fa-arrow-right ml-2"></i></a>
            </div>

        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                    sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Instagram</p>
                <div class="grid grid-cols-3 gap-3">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
                </div>
                <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                    <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                </a>
            </div>

        </aside>

    </div>
@endsection
