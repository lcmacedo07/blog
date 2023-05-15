@extends('layouts.backend')

@section('content')
   <div class="container">

    <h1 class="font-bold mb-3 text-xl">POSTS</h1>

    <div class="card">
        <div class="card-body">
            <div class="block-header">
                <a class="btn btn-primary waves-effect" href="{{ route('posts.create') }}">
                    NOVO REGISTRO
                </a>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>visibility</th>
                    <th>Está Aprovado</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th width="150px"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($posts as $data)
                    <tr>
                      {{-- <td>{{ str_limit($data->title, '10') }}</td> --}}
                      <td>{{ $data->title }}</td>
                      <td>{{ $data->user->name }}</td>
                      @if ($data->categories->isNotEmpty())
                          <td>{{ $data->categories->first()->name }}</td>
                      @else
                          <td>Sem categoria</td>
                      @endif
                      <td>{{ $data->view_count }}</td>
                      <td>
                        @if($data->is_approved == true)
                            <span>Aprovado</span>
                        @else
                            <span>Pendente</span>
                        @endif
                      </td>
                      <td>
                        @if($data->status == true)
                            <span>Publicado</span>
                        @else
                            <span>Pendente</span>
                        @endif
                      </td>
                      <td>{{ $data->created_at  }}</td>
                      <td class="text-right">
                        <div class="flex space-x-2">
                            <a href="{{ route('posts.show', $data->id) }}"
                                class="text-sm text-white bg-blue-400 rounded p-1 px-2 hover:bg-blue-600">Visualizar
                            </a>
                            <a href="{{ route('posts.edit', $data->id) }}"
                                class="text-sm text-white bg-blue-400 rounded p-1 px-2 hover:bg-blue-600">Editar
                            </a>
                            <a class="text-sm text-white bg-red-500 rounded p-1 px-2 hover:bg-red-600 cursor-pointer"
                                onclick="deletePost({{ $data->id }})">
                                Excluir
                            </a>
                            <form id="delete-form-{{ $data->id }}"
                                action="{{ route('posts.destroy', $data->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                      </td>
                    </tr>
                     @endforeach
                </tbody>
              </table>

            {{ $posts->links() }}
        </div>
    </div>
    
    
</div>
@endsection

<script type="text/javascript">
  function deletePost(id) {
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: true,
          reverseButtons: true
      }).then((result) => {
          if (result.value) {
              event.preventDefault();
              document.getElementById('delete-form-'+id).submit();
          } else if (
              // Read more about handling dismissals
              result.dismiss === swal.DismissReason.cancel
          ) {
              swal(
                  'Cancelled',
                  'Your data is safe :)',
                  'error'
              )
          }
      })
  }
</script>