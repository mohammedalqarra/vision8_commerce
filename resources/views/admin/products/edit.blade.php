@extends('admin.master')

@section('title', 'Edit Product | ' . env('APP_NAME'))

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Edit Products</h1>

    @if (session('msg'))
        <div class="alert alert-{{ seesion('type') }}">
            {{ seesion('msg') }}
        </div>
    @endif
    @include('admin.errors')
    <style>
        .id_1 {
            font-size: 18px;
            padding: 7px 35px;
            border-radius: 550px;
        }
    </style>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('admin.products._form')
        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
