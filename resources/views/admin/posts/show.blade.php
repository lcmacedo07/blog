@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="post">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <p class="post-meta">Postado por <a href="#">{{ $post->user->name }}</a> em {{ $post->created_at }}
                    </p>
                    <div class="post-body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-cyan text-white">
                        Categorias
                    </div>
                    <div class="card-body">
                        @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-green text-white">
                        Tags
                    </div>
                    <div class="card-body">
                        @foreach ($post->tags as $tag)
                            <span class="label bg-green">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-amber text-white">
                        Imagem em Destaque
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{ Storage::disk('public')->url('post/' . $post->image) }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-right">
                <a href="{{ route('posts.index') }}" class="btn btn-danger">Voltar</a>
                @if (!$post->is_approved)
                    {{-- <button type="button" class="btn btn-success" onclick="approvePost({{ $post->id }})">
                        <i class="material-icons">done</i> Aprovar
                    </button>
                     --}}
                    <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost(event, {{ $post->id }})">
                        <i class="material-icons">done</i>
                        <span>Aprovar</span>
                    </button>
                    
                    <form method="post" action="{{ route('post.approve', $post->id) }}" id="approval-form"
                        style="display: none">
                        @csrf
                        @method('PUT')
                    </form>
                @else
                    <button type="button" class="btn btn-success" disabled>
                        <i class="material-icons">done</i> Aprovar
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .post {
        margin-bottom: 30px;
    }

    .post-title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .post-meta {
        font-size: 14px;
        color: #888;
        margin-bottom: 20px;
    }

    .post-body {
        line-height: 1.6;
    }

    .card-header {
        font-size: 18px;
        padding: 10px;
    }

    .label {
        display: inline-block;
        font-size: 12px;
        padding: 5px 10px;
        margin-bottom: 5px;
        border-radius: 3px;
        color: #fff;
        margin-right: 5px;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .btn {
        margin-top: 10px;
    }

    .btn i {
        margin-right: 5px;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: #fff;
    }
</style>

<script>
    function approvePost(event, id) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: 'Deseja aprovar este post?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, aprovar!',
        cancelButtonText: 'Não, cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            event.preventDefault();
            document.getElementById('approval-form').submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'O post continua pendente :)',
                'info'
            );
        }
    });
}


</script>
