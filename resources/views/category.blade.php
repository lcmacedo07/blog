@extends('layouts.frontend')

@section('content')
    <div class="container mx-auto flex flex-wrap py-6">


        <div class="slider display-table center-text">
            <h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
        </div><!-- slider -->

        <div class="row">
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
                        <article class="flex flex-col shadow my-4">
                            <a class="hover:opacity-75">
                                <img src="{{ Storage::disk('public')->url('post/' . $post->image) }}"
                                    alt="{{ $post->title }}">
                            </a>
                            <div class="bg-white flex flex-col justify-start p-6">
                                <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $category->name }}</a>
                                <h1 class="text-2xl font-bold pb-3">{{ $post->title }}</h1>
                                <p class="pb-3">{!! html_entity_decode($post->body) !!}</p>
                            </div>
                        </article>
                    </section>
                @endforeach
            @else
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-info">
                                <h4 class="title">
                                    <strong>Sorry, No post found :(</strong>
                                </h4>
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endif
        </div>

    </div>
@endsection
