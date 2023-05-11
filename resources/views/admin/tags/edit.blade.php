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

        <h1 class="font-bold mb-3 text-xl">EDITAR TAG</h1>
        
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tags.update', $tags->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 pb-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Nome</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $tags->name }}" placeholder="Nome">
                                </div>
                                @if ($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                <br>
                <a class="text-sm text-white bg-gray-500 rounded ml-2 p-1 px-2 hover:bg-gray-600 cursor-pointer"
                    href="{{ route('tags.index') }}">VOLTAR</a>
                <button type="submit"
                    class="text-sm text-white bg-blue-400 rounded ml-2 p-1 px-2 hover:bg-blue-600">SALVAR</button>
                </form>
            </div>
        </div>
            
    </div>
@endsection