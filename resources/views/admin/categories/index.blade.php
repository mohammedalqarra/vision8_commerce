@extends('admin.master')

@section('title', 'Categories | ' . env('APP_NAME'))

@section('content')

    <h1 class="h3 mb-4 text-gray-800">All Categories</h1>

    {{-- @if (session('fail'))
        <div class="alert alert-danger">
            {{ seesion('fail') }}
        </div>
    @endif

    @if (session('succes'))
        <div class="alert alert-succes">
            {{ seesion('succes') }}
        </div>
    @endif --}}

    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif
    <form action="{{ route('admin.categories.index') }}" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search here..." name="category"
                value="{{ request()->category }}">
            <button class="btn btn-dark px-5" id="button-addon2">Search</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-dark text-white">
                <th>ID</th>
                <th>Nmae</th>
                <th>Image</th>
                <th>Parent</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->trans_name }}</td>
                    <td><img width="80" src="{{ asset('uploads/categories/' . $category->image) }}"></td>
                    {{-- <td>{{ $category->parent_id }}</td> --}}
                    <td>{{ $category->parent->trans_name }}</td>
                    <th>{{ $category->created_at ? $category->created_at->diffForHumans() : '' }}</th>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.categories.edit', $category->id) }}"><i
                                class="fa fa-edit"></i></a>
                        {{-- confirm delte --}}
                        <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                        <form class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
    {{-- {{ $categories->appends($_GET)->links() }} --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <script>
        $('.btn-delete').on('click', function() {

            let form = $(this).next('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    </script>
@stop
