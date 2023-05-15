@extends('layouts.frontend')

@section('content')
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <article>
                <div class="bg-white flex flex-col justify-start p-6 h-full">
                    <!-- Article Image -->
                    <a class="hover:opacity-75">
                        <img class="w-full h-auto" src="{{ Storage::disk('public')->url('post/' . $post->image) }}" alt="{{ $post->title }}">
                    </a>
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
                    <h1 class="text-2xl font-bold pb-3">{{ $post->title }}</h1>
                    <p class="pb-3">{!! html_entity_decode($post->body) !!}</p>

                </div>
            </article>


            <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
                <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                    <img src="{{ Storage::disk('public')->url('profile/' . $post->user->image) }}"
                        class="rounded-full shadow h-32 w-32">
                    {{-- <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1"
                        class="rounded-full shadow h-32 w-32"> --}}
                </div>
                <div class="flex-1 flex flex-col justify-center md:justify-start">
                    <p class="font-semibold text-2xl">{{ $post->user->name }}</p>
                    {{-- <p class="pt-2">{{ $post->user->about }}</p> --}}
                    <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                        <a class="" href="{{ $post->user->facebook }}">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a class="pl-4" href="{{ $post->user->instagram }}">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="pl-4" href="{{ $post->user->twitter }}">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="pl-4" href="{{ $post->user->linkedin }}">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us - {{ $post->user->name }}</p>
                <p class="pb-2">{{ $post->user->about }}</p>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Ultimos Posts</p>
                <div class="grid grid-cols-3 gap-3">

                    @foreach ($randomposts as $post)
                        <a href="{{ route('post.details', $post->slug) }}" class="hover:opacity-75">
                            <img class="hover:opacity-75" src="{{ Storage::disk('public')->url('post/' . $post->image) }}"
                                alt="{{ $post->title }}" style="object-fit: cover; width: 300px; height: 150px;">
                        </a>
                    @endforeach
                </div>
            </div>

        </aside>

    </div>
@endsection
