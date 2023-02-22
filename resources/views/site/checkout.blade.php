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
                        {{-- <span style="margin-bottom:10px">Checkout form will be here ...</span> --}}
                        <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>
                        <form action="{{ route('site.payment') }}" class="paymentWidgets" data-brands="VISA MASTER AMEX MADA"></form>

                        {{-- <div id="smart-button-container">
                            <div style="text-align: center;">
                              <div id="paypal-button-container"></div>
                            </div>
                          </div>
                        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
                        <script>
                          function initPayPalButton() {
                            paypal.Buttons({
                              style: {
                                shape: 'rect',
                                color: 'blue',
                                layout: 'vertical',
                                label: 'checkout',

                              },

                              createOrder: function(data, actions) {
                                return actions.order.create({
                                  purchase_units: [{"amount":{"currency_code":"USD","value":100}}]
                                });
                              },

                              onApprove: function(data, actions) {
                                return actions.order.capture().then(function(orderData) {

                                  // Full available details
                                  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                                  // Show a success message within this page, e.g.
                                  const element = document.getElementById('paypal-button-container');
                                  element.innerHTML = '';
                                  element.innerHTML = '<h3>Thank you for your payment!</h3>';

                                  // Or go to another URL:  actions.redirect('thank_you.html');

                                });
                              },

                              onError: function(err) {
                                console.log(err);
                              }
                            }).render('#paypal-button-container');
                          }
                          initPayPalButton();
                        </script> --}}
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
                                                <span>${{ $cart->product->price }}</span>
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
                                            <span class="price">${{ $cart->product->price }}</span>
                                        </li>
                                        <li>
                                            <span>Shipping:</span>
                                            <span>Free</span>
                                        </li>
                                    </ul>
                                    <div class="summary-total">
                                        <span>Total</span>
                                        <span>${{ $cart->quantity *  $cart->product->price }}</span>
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
