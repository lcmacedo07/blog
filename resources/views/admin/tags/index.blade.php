@extends('layouts.backend')

@section('content')
   <div class="container">

    <h1 class="font-bold mb-3 text-xl">TAGS</h1>

    <div class="card">
        <div class="card-body">
            <div class="block-header">
                <a class="btn btn-primary waves-effect" href="{{ route('tags.create') }}">
                    NOVO REGISTRO
                </a>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Contagem dos Post</th>
                    <th width="150px"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tags as $data)
                    <tr>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->posts->count() }}</td>
                      <td class="text-right">
                        <a href="{{ route('tags.edit', $data->id) }}"
                            class="text-sm text-white bg-blue-400 rounded ml-2 p-1 px-2 hover:bg-blue-600">Editar
                        </a>
                        <a class="text-sm text-white bg-red-500 rounded ml-2 p-1 px-2 hover:bg-red-600 cursor-pointer"
                            onclick="deleteTag({{ $data->id }})">
                            Excluir
                        </a>
                        <form id="delete-form-{{ $data->id }}"
                            action="{{ route('tags.destroy', $data->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    </tr>
                     @endforeach
                </tbody>
              </table>

            {{ $tags->links() }}
        </div>
    </div>
    
    
</div>
@endsection

<script type="text/javascript">
  function deleteTag(id) {
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