@extends('admin.master')

@section('title', 'Edit Category | ' . env('APP_NAME'))

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Edit Categories</h1>

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
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>English name</label>
            <input type="text" name="name_en" placeholder="English name" class="form-control"
                value="{{ $category->name_en }}" />
        </div>
        <div class="mb-3">
            <label>Arabic name</label>
            <input type="text" name="name_ar" placeholder="Arabic name" class="form-control"
                value="{{ $category->name_ar }}" />
        </div>
        <div class="mb-3">
            {{-- <i class="fa-solid fa-cloud-arrow-up"></i> --}}
            <label for="image" class="id_1 form-control">uploade Image</label>
            <input type="file" id="image" name="image" class="form-control d-none" />
            {{-- <span>upload image</span> --}}
            <img width="80" src="{{ asset('uploads/categories/' . $category->image) }}" alt="">
        </div>
        <div class="mb-3">
            <label>Parent</label>
            <select name="parent_id" class="form-control">
                <option value="">Select</option>
                @foreach ($categories as $item)
                    {{-- <option {{ $category->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option> --}}
                    <option {{ $category->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success px-5">Update</button>
    </form>
@stop
