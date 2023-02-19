@extends('site.master')


@section('title', ' Cart | ' . config('app.name'))



@section('content')


    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Cart</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">cart</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">
        <div class="cart shopping">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="block">
                            <div class="product-list">
                                @if (auth()->user()->carts->count() > 0)
                                    <form method="POST" action="{{ route('site.update_cart') }}">
                                        @csrf
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="">Name</th>
                                                    <th class="">Price</th>
                                                    <th class="">Quantity</th>
                                                    <th class="">Total</th>
                                                    <th class="">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach (auth()->user()->carts as $cart)
                                                    <tr class="">
                                                        <td class="">
                                                            <div class="product-info">
                                                                <img width="80"
                                                                    src="{{ asset('uploads/products/' . $cart->product->image) }}"
                                                                    alt="">
                                                                <a
                                                                    href="{{ route('site.product', $cart->product->slug) }}">{{ $cart->product->trans_name }}</a>
                                                            </div>
                                                        </td>
                                                        <td class="">${{ $cart->price }}</td>
                                                        <td class=""><input type="number" name="qyt[{{ $cart->product->id }}]"
                                                                value="{{ $cart->quantity }}" style="width:50px"></td>
                                                        <td class="">${{ $cart->quantity * $cart->price }}</td>
                                                        <td class="">
                                                            <a class="product-remove" href="{{ route('site.remove_cart' , $cart->id) }}">Remove</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button class="btn btn-solid-border"> Update Cart</button>
                                        <a href="{{ route('site.checkout') }}" class="btn btn-main pull-right">Checkout</a>
                                    </form>
                                @else
                                    <div class="text-center">
                                        <a href="{{ route('site.shop') }}" class="btn btn-main">Shop Now</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
