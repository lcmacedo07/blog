@extends('layouts.backend')

@section('content')


    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="font-bold mb-3 text-xl">EDITAR POST</h1>
        
        <div class="card">
            <div class="card-body">
                <form action="{{ route('posts.update', $posts->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 pb-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Titulo do Post</label>
                                    <input type="text" id="title" class="form-control" name="title" value="{{ $posts->title }}" placeholder="Titulo do Post">
                                </div>
                                @if ($errors->has('title'))
                                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 pb-3">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Imagem em Destaque</label>
                                    <input type="file" id="image" class="form-control" name="image" value="{{ $posts->image }}" placeholder="Imagem em Destaque">
                                </div>
                                @if ($errors->has('image'))
                                    <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 pb-3">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="publish">Publicar</label>
                                    <input type="checkbox" id="publish" class="filled-in" name="status" value="{{ $posts->status }}" value="1">
                                </div>
                                @if ($errors->has('image'))
                                    <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label for="category">Categoria</label>
                                    <select name="category_id" value="{{ $posts->category_id }}" id="category" class="form-select"
                                        aria-label="Default select example">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3">
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tag">Tag</label>
                                    <select name="tag_id" value="{{ $posts->tag_id }}" id="tag" class="form-select"
                                        aria-label="Default select example">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pb-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Body</label>
                                    <input type="textarea" id="body" class="form-control" name="body" value="{{ $posts->body }}" placeholder="Body">
                                </div>
                                @if ($errors->has('body'))
                                <div class="alert alert-danger">{{ $errors->first('body') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                <br>
                <a class="text-sm text-white bg-gray-500 rounded ml-2 p-1 px-2 hover:bg-gray-600 cursor-pointer"
                    href="{{ route('posts.index') }}">VOLTAR</a>
                <button type="submit"
                    class="text-sm text-white bg-blue-400 rounded ml-2 p-1 px-2 hover:bg-blue-600">SALVAR</button>
                </form>
            </div>
        </div>
            
    </div>
@endsection