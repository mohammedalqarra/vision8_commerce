@extends('site.master')


@section('title', ' Cart | ' . config('app.name'))



@section('content')


    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Checkout</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">checkout</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="page-wrapper">
        <div class="checkout shopping">
            <div class="container">
                @if (auth()->user()->carts->count() > 0)
                <div class="row">

                    <div class="col-md-8">
                        Checkout form will be here ...
                    </div>
                    <div class="col-md-4">

                        <div class="product-checkout-details">
                            @php
                                $total = 0;
                            @endphp
                            @foreach (auth()->user()->carts as $cart)
                                <div class="block">
                                    <h4 class="widget-title">Order Summary</h4>
                                    <div class="media product-card">
                                        <a class="pull-left" href="{{ route('site.product', $cart->product->slug) }}">
                                            <img class="media-object"
                                                src="{{ asset('uploads/products/' . $cart->product->image) }}"
                                                alt="Image">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="{{ route('site.product' , $cart->product->slug) }}">{{ $cart->product->trans_name }}
                                                    </a></h4>
                                            <p class="price"><span>{{ $cart->quantity }} x</span>
                                                <span>${{ $cart->price }}</span>
                                            </p>
                                            <span class="remove"><a
                                                    href="{{ route('site.remove_cart', $cart->id) }}">Remove</a></span>
                                        </div>
                                    </div>
                                    <div class="discount-code">
                                        <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal"
                                                href="#!">enter it here</a></p>
                                    </div>
                                    <ul class="summary-prices">
                                        <li>
                                            <span>Subtotal:</span>
                                            <span class="price">${{ $cart->price }}</span>
                                        </li>
                                        <li>
                                            <span>Shipping:</span>
                                            <span>Free</span>
                                        </li>
                                    </ul>
                                    <div class="summary-total">
                                        <span>Total</span>
                                        <span>${{ $cart->quantity * $cart->price }}</span>
                                    </div>
                                    <div class="verified-icon">
                                        <img src="{{ asset('siteassets/images/shop/verified.png') }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                @else
                <div class="text-center">
                    <a href="{{ route('site.shop') }}" class="btn btn-main">Shop Now</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@stop
