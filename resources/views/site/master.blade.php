<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>@yield('title | ' . config('app.name'))</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Constra HTML Template v1.0">

    <!-- theme meta -->
    <meta name="theme-name" content="aviato" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('siteassets/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Themefisher Icon font -->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/themefisher-font/style.css') }}">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- Animate css -->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/animate/animate.css') }}">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/slick/slick-theme.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('siteassets/css/style.css') }}">
    @yield('styles')
</head>

<body id="body">

    <!-- Start Top Header Bar -->
    <section class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <div class="contact-number">
                        <a href="tel:0129- 12323-123123">
                            <i class="tf-ion-ios-telephone"></i>
                            <span>0129- 12323-123123</span>
                            <br>
                            <br>
                        </a>
                        <br>
                        @auth
                            <div
                                style="width:750px; height:118px;border:2px solid #0000001f;border-radius:25px; padding:15px">
                                <p style="font-size:15px; color:#000;">{{ now()->format('l , F d') }}th
                                    <span style="color:#000; font-size:20px">Welcome {!! Str::words(auth()->user()->name, 1, ' ...') !!}</span>
                                </p>

                                @php
                                    /* This sets the $time variable to the current hour in the 24 hour clock format */
                                    $time = date('H');
                                    /* Set the $timezone variable to become the current timezone */
                                    $timezone = date('e');
                                    /* If the time is less than 1200 hours, show good morning */
                                    if ($time < '12') {
                                        echo '<span style="font-size:40px;color:#000;font-family: "Bitter", serif;">Good morning</span>';
                                    } /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
                                    elseif ($time >= '12' && $time < '17') {
                                        echo '<span style="font-size:40px;color:#000;font-family: "Bitter", serif;">Good afternoon</span>';
                                    } /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                                    elseif ($time >= '17' && $time < '19') {
                                        echo '<span style="font-size:40px;color:#000;font-family: "Bitter", serif;">Good evening</span>';
                                    } /* Finally, show good night if the time is greater than or equal to 1900 hours */
                                    elseif ($time >= '19') {
                                        echo '<span style="font-size:40px;color:#000;font-family: "Bitter", serif;">Good night</span>';
                                    }
                                @endphp

                            </div>
                        @endauth

                        <img width="40"
                            src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png">
                        :
                        {{ $weather['main']['temp'] }}°C
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <!-- Site Logo -->
                    <div class="logo text-center">
                        <a href="{{ route('site.index') }}">
                            <!-- replace logo here -->
                            <svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    font-size="40" font-family="AustinBold, Austin" font-weight="bold">
                                    <g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
                                        <text id="AVIATO">
                                            <tspan x="108.94" y="325">AVIATO</tspan>
                                        </text>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <!-- Cart -->
                    <ul class="top-menu text-right list-inline">
                        {{-- <li> <a href="{{ route('admin.auth.login') }}"><i class="card-header">{{ __('Login') }}</i></a></li> --}}
                        <li class="dropdown cart-nav dropdown-slide">

                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
                                    class="tf-ion-android-cart"></i>Cart</a>

                            <div class="dropdown-menu cart-dropdown">
                                @php
                                    $total = 0;
                                @endphp
                                @auth
                                    @foreach (Auth()->user()->carts as $cart)
                                        <!-- Cart Item -->
                                        <div class="media">
                                            <a class="pull-left" href="{{ route('site.product', $cart->product->slug) }}">
                                                <img class="media-object"
                                                    src="{{ asset('uploads/products/' . $cart->product->image) }}"
                                                    alt="image" />
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a
                                                        href="{{ route('site.product', $cart->product->slug) }}">{{ $cart->product->trans_name }}</a>
                                                </h4>
                                                <div class="cart-price">
                                                    <span>{{ $cart->quantity }} x</span>
                                                    <span>${{ $cart->product->price }}</span>
                                                </div>
                                                <h5><strong>${{ $cart->quantity * $cart->product->price }}</strong></h5>
                                            </div>
                                            <a href="{{ route('site.remove_cart', $cart->id) }}" class="remove"><i
                                                    class="tf-ion-close"></i></a>
                                        </div><!-- / Cart Item -->
                                        @php
                                            $total += $cart->quantity * $cart->product->price;
                                        @endphp
                                    @endforeach
                                @endauth

                                <div class="cart-summary">
                                    <span>Total</span>
                                    <span class="total-price">${{ number_format($total, 2) }}</span>
                                </div>
                                <ul class="text-center cart-buttons">
                                    <li><a href="{{ route('site.cart') }}" class="btn btn-small">View Cart</a></li>
                                    <li><a href="{{ route('site.checkout') }}"
                                            class="btn btn-small btn-solid-border">Checkout</a>
                                    </li>
                                </ul>
                            </div>

                        </li><!-- / Cart -->

                        <!-- Search -->
                        <li class="dropdown search dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
                                    class="tf-ion-ios-search-strong"></i> Search</a>
                            <ul class="dropdown-menu search-dropdown">
                                <li>
                                    <form action="{{ route('site.search') }}" method="GET"><input type="search"
                                            name="search" class="form-control" value="{{ request()->search }}"
                                            placeholder="Search..."></form>
                                </li>
                            </ul>
                        </li><!-- / Search -->

                        <!-- Languages -->
                        <li class="commonSelect">
                            <select class="form-control" onchange="window.location.href=this.value">
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <option @selected($localeCode == app()->currentLocale())
                                        value="{{ LaravelLocalization::getLocalizedURl($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}</option>
                                @endforeach
                            </select>
                        </li><!-- / Languages -->

                    </ul><!-- / .nav .navbar-nav .navbar-right -->
                </div>
            </div>
        </div>
    </section><!-- End Top Header Bar -->


    <!-- Main Menu Section -->
    <section class="menu">
        <nav class="navbar navigation">
            <div class="container">
                <div class="navbar-header">
                    <h2 class="menu-title">Main Menu</h2>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div><!-- / .navbar-header -->

                <!-- Navbar Links -->
                <div id="navbar" class="navbar-collapse collapse text-center">
                    <ul class="nav navbar-nav">

                        <!-- Home -->
                        <li class="dropdown ">
                            <a href="{{ route('site.index') }}">Home</a>
                        </li><!-- / Home -->

                        <!-- About -->
                        <li class="dropdown ">
                            <a href="{{ route('site.about') }}">About</a>
                        </li><!-- / About -->

                        <!-- shop -->
                        <li class="dropdown ">
                            <a href="{{ route('site.shop') }}">shop</a>
                        </li><!-- / shop -->


                        <!-- Categories -->
                        <li class="dropdown dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true"
                                aria-expanded="false">Categories
                                <span class="tf-ion-ios-arrow-down"></span></a>
                            <ul class="dropdown-menu">
                                @foreach (\App\Models\Category::all() as $item)
                                    <li><a href="{{ route('site.category', $item->id) }}">{{ $item->trans_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li><!-- / Blog -->

                        <!-- contact -->
                        <li class="dropdown ">
                            <a href="{{ route('site.contact') }}">contact</a>
                        </li><!-- / contact -->


                    </ul><!-- / .nav .navbar-nav -->

                </div>
                <!--/.navbar-collapse -->
            </div><!-- / .container -->
        </nav>
    </section>

    @yield('content')

    <footer class="footer section text-center mb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="social-media">
                        <li>
                            <a href="https://www.facebook.com/themefisher">
                                <i class="tf-ion-social-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/themefisher">
                                <i class="tf-ion-social-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/themefisher">
                                <i class="tf-ion-social-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.pinterest.com/themefisher/">
                                <i class="tf-ion-social-pinterest"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="footer-menu text-uppercase">
                        <li>
                            <a href="{{ route('site.contact') }}">CONTACT</a>
                        </li>
                        <li>
                            <a href="{{ route('site.shop') }}">SHOP</a>
                        </li>
                        <li>
                            <a href="pricing.html">Pricing</a>
                        </li>
                        <li>
                            <a href="contact.html">PRIVACY POLICY</a>
                        </li>
                    </ul>
                    <p class="copyright-text">Copyright &copy;{{ date('Y') }}, Designed &amp; Developed by <a
                            href="https://themefisher.com/">Themefisher</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!--
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="{{ asset('siteassets/plugins/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.1 -->
    <script src="{{ asset('siteassets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap Touchpin -->
    <script src="{{ asset('siteassets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <!-- Instagram Feed Js -->
    <script src="{{ asset('siteassets/plugins/instafeed/instafeed.min.js') }}"></script>
    <!-- Video Lightbox Plugin -->
    <script src="{{ asset('siteassets/plugins/ekko-lightbox/dist/ekko-lightbox.min.js') }}"></script>
    <!-- Count Down Js -->
    <script src="{{ asset('siteassets/plugins/syo-timer/build/jquery.syotimer.min.js') }}"></script>

    <!-- slick Carousel -->
    <script src="{{ asset('siteassets/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('siteassets/plugins/slick/slick-animation.min.js') }}"></script>

    <!-- Google Mapl -->
    <script
        src="{{ asset('siteassets/https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw') }}">
    </script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/google-map/gmap.js') }}"></script>

    <!-- Main Js File -->
    <script src="{{ asset('siteassets/js/script.js') }}"></script>
    {{-- {{ asset('siteassets/') }} --}}
    @yield('scripts')
</body>

</html>
