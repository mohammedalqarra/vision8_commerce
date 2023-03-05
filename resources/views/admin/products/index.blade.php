@extends('admin.master')

@section('title', 'Products | ' . env('APP_NAME'))

@section('content')

    <h1 class="h3 mb-4 text-gray-800">All Products</h1>

    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif
    <form action="{{ route('admin.products.index') }}" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search here..." name="product"
                value="{{ request()->product }}">
            <button class="btn btn-dark px-5" id="button-addon2">Search</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-dark text-white">
                <th>ID</th>
                <th>Nmae</th>
                <th>Image</th>
                <th>price</th>
                <th>Sale Price</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            @if ($product->quantity > 0)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->trans_name }}</td>
                <td><img width="80" src="{{ asset('uploads/products/' . $product->image) }}"></td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->sale_price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category->trans_name }}</td>
                <th>{{ $product->created_at ? $product->created_at->diffForHumans() : '' }}</th>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.products.edit', $product->id) }}"><i
                            class="fa fa-edit"></i></a>
                    {{-- confirm delte --}}
                    <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                    <form class="d-inline" action="{{ route('admin.products.destroy', $product->id) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                    </form>
                </td>
            </tr>
            @endif

            @endforeach
        </tbody>
    </table>
    {{-- {{ $products->links() }} --}}
    {{ $products->appends($_GET)->links() }}

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
