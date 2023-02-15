@extends('site.master')

@section('title', 'shop |' . config('app.name'))

@section('content')


<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <form action="{{ route('site.search') }}" method="GET"><input type="search" class="form-control"
                    placeholder="Search..." name="search" value="{{ request()->search }}">
            </form>
			</div>
		</div>
	</div>
</section>
<section class="products section">
	<div class="container">

        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
                @include('site.includes.product')
            </div>
            @endforeach

        </div>

        {{ $products->links() }}
	</div>
</section>
@stop


