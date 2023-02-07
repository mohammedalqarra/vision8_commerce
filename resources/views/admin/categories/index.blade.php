@extends('admin.master')

@section('title', 'Categories | ' . env('app.name'))


@section('content')
    <h1 class="h3 mb-4 text-gray-800">All Categories</h1>

    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <form action="{{ route('admin.categories.index') }}" method="POST" enctype="multipart/form-data">
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
                <th>Name</th>
                <th>Image</th>
                <th>Parent</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $category)
             {{-- @dump(json_decode($category->name, true)[app()->currentLocale()]) --}}
                <tr>
                    <td>{{ $category->id }}</td>
                    {{-- <td>{{ json_decode($category->name, true)[app()->currentLocale()] }}</td> --}}
                    <td>{{ $category->name }}</td>
                    <td><img  width="50" src="{{ asset('uploads/categories/' . $category->image ) }}" alt=""></td>
                    <td>{{ $category->parent_id }}</td>

                    <th>{{ $category->created_at ? $category->created_at->diffForHumans() : '' }}</th>
                    <td><a class="btn btn-sm btn-primary"href="{{ route('admin.categories.edit', $category->id) }}"><i
                                class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->appends($_GET)->links() }}
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
