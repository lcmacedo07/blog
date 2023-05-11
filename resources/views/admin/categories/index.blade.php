@extends('layouts.backend')

@section('content')
   <div class="container">

    <h1 class="font-bold mb-3 text-xl">CATEGORIAS</h1>

    <div class="card">
        <div class="card-body">
            <div class="block-header">
                <a class="btn btn-primary waves-effect" href="{{ route('categories.create') }}">
                    NOVO REGISTRO
                </a>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Slug</th>
                    <th>Imagem</th>
                    <th width="150px"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $data)
                    <tr>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->slug }}</td>
                      {{-- <td>{{ $data->image }}</td> --}}
                      <td width="225px">
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('category/'.$data->image) }}" alt="">
                      </td>
                      <td class="text-right">
                        <div class="flex space-x-2">
                            <a href="{{ route('categories.edit', $data->id) }}"
                                class="text-sm text-white bg-blue-400 rounded p-1 px-2 hover:bg-blue-600">Editar
                            </a>
                            <a class="text-sm text-white bg-red-500 rounded p-1 px-2 hover:bg-red-600 cursor-pointer"
                                onclick="deleteCategory({{ $data->id }})">
                                Excluir
                            </a>
                            <form id="delete-form-{{ $data->id }}"
                                action="{{ route('categories.destroy', $data->id) }}" method="POST"
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

            {{ $categories->links() }}
        </div>
    </div>
    
    
</div>
@endsection

<script type="text/javascript">
  function deleteCategory(id) {
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