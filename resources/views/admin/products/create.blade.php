@extends('admin.master')

@section('title', 'Add new Products | ' . env('APP_NAME'))

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Create new Products</h1>

    @if (session('msg'))
        <div class="alert alert-{{ seesion('type') }}">
            {{ seesion('msg') }}
        </div>
    @endif
    @include('admin.errors')

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.products._form')
        <button class="btn btn-success px-5">Add</button>
    </form>
@stop
