@extends('site.master')

@section('styles')
<style>
  span form   button{
        border: 0 ;
        background:transparent;
    }
</style>
@endsection

@section('content')
<br>
<br>
    <div class="container">


            <div class="list-group">
                @foreach (auth()->user()->notifications as $notification)
                <a href="{{ route('readd' , $notification->id ) }}" class="list-group-item {{ $notification->read_at ? 'active' : '' }}">
                    {{ $notification->data['data'] }}
                    <span class="badge">
                        <form action="{{ route('deleteed' , $notification->id ) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button>Delete</button></form>
                    </span>
                  </a>
                @endforeach
              </div>

    </div>
@stop
