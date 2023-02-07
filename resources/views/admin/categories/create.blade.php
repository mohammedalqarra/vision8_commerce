@extends('admin.master')

@section('title', 'Add new Category | ' . env('APP_NAME'))

@section('content')

    <h1 class="h3 mb-4 text-gray-800">Create new Categories</h1>

    @if (session('msg'))
        <div class="alert alert-{{ seesion('type') }}">
            {{ seesion('msg') }}
        </div>
    @endif
    @include('admin.errors')

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>English name</label>
            <input type="text" name="name_en" placeholder="English name" class="form-control" />
        </div>
        <div class="mb-3">
            <label>Arabic name</label>
            <input type="text" name="name_ar" placeholder="Arabic name" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control" />

            {{-- <label for="image"><img src="https://placekitten.com/120" alt=""></label>
            <input type="file" id="image" name="name_en" class="form-control d-none" />
             --}}
        </div>
        <div class="mb-3">
            <label>Parent</label>
            <select name="parent_id" class="form-control">
                <option value="">Select</option>
                @foreach ($categories as $Category)
                    {{-- <option value="{{ $Category->id }}">{{ $Category->name }}</option> --}}
                    <option value="{{ $Category->id }}">{{ $Category->trans_name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success px-5">Add</button>
    </form>
@stop
