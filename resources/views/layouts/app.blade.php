<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ asset('css/core.css') }}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ asset('css/shortcode/shortcodes.css') }}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- User style -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Modernizr JS -->
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>

</head>
<body>
    <div id="app">
        <!-- Body main wrapper start -->
        <div class="wrapper fixed__footer">
            <!-- Start Header Style -->
            <header id="header" class="htc-header header--3 bg__white">
                <!-- Start Mainmenu Area -->
                <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                                <div class="logo">
                                    <a href="{{ route('home') }}" style="font-size: 26px; text-transform: uppercase;">
                                        L{{ config('app.name', 'arashop') }}
                                    </a>
                                </div>
                            </div>
                            <!-- Start MAinmenu Ares -->
                            <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            </div>
                            <!-- End MAinmenu Ares -->
                            <div class="col-md-2 col-sm-4 col-xs-3">
                                <ul class="main__menu menu-extra">
                                    {{-- <li class="search search__open hidden-xs"><span class="ti-search"></span></li> --}}
                                    @guest
                                        <li>
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li>
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="drop"><a href="#" style="white-space: nowrap;">{{ Auth::user()->name }}</a>
                                            <ul class="dropdown">
                                                <li style="padding: 0;">
                                                    <a href="{{ route('admin_dashboard') }}">{{ __('Admin Panel') }}</a>
                                                </li>
                                                <li style="padding: 0;">
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="cart__menu"><span class="ti-shopping-cart"></span></li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                        <div class="mobile-menu-area"></div>
                    </div>
                </div>
                <!-- End Mainmenu Area -->
            </header>
            <!-- End Header Style -->

            <div class="body__overlay"></div>

            @guest

            @else
                <div class="shopping__cart">
                    <div class="shopping__cart__inner">
                        <div class="offsetmenu__close__btn">
                            <a href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                        <div class="shp__cart__wrap">
                            <div class="shp__single__product">
                                <div class="shp__pro__thumb">
                                    <a href="#">
                                        <img src="images/product/sm-img/1.jpg" alt="product images">
                                    </a>
                                </div>
                                <div class="shp__pro__details">
                                    <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                    <span class="quantity">QTY: 1</span>
                                    <span class="shp__price">$105.00</span>
                                </div>
                                <div class="remove__btn">
                                    <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                                </div>
                            </div>
                            <div class="shp__single__product">
                                <div class="shp__pro__thumb">
                                    <a href="#">
                                        <img src="images/product/sm-img/2.jpg" alt="product images">
                                    </a>
                                </div>
                                <div class="shp__pro__details">
                                    <h2><a href="product-details.html">Brone Candle</a></h2>
                                    <span class="quantity">QTY: 1</span>
                                    <span class="shp__price">$25.00</span>
                                </div>
                                <div class="remove__btn">
                                    <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                                </div>
                            </div>
                        </div>
                        <ul class="shoping__total">
                            <li class="subtotal">Subtotal:</li>
                            <li class="total__price">$130.00</li>
                        </ul>
                        <ul class="shopping__btn">
                            <li><a href="cart.html">View Cart</a></li>
                            <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            @endguest
            @yield('content')
            <!-- Start Footer Area -->
            <footer class="htc__foooter__area gray-bg">
                <div class="container">
                    <div class="footer__container text-center">
                        <div class="ft__widget">
                            <div class="ft__logo">
                                <a href="{{ route('home') }}" style="font-size: 46px; text-transform: uppercase;">
                                    L{{ config('app.name', 'arashop') }}
                                </a>
                            </div>
                            {{-- <div class="footer-address">
                                <div style="margin-bottom: 20px; font-size: 16px;">
                                    <i class="zmdi zmdi-pin" style="margin-right: 5px;"></i>
                                    <a href="#"> Phnom penh, Cambodia</a>
                                </div>
                                <div style="margin-bottom: 20px; font-size: 16px;">
                                    <i class="zmdi zmdi-email" style="margin-right: 5px;"></i>
                                    <a href="#"> larashop@email.com</a>
                                </div>
                                <div style="margin-bottom: 20px; font-size: 16px;">
                                    <i class="zmdi zmdi-phone-in-talk" style="margin-right: 5px;"></i>
                                    <a href="#"> +855 012 345 678</a>
                                </div>
                            </div> --}}
                            <ul class="social__icon" style="justify-content: center;">
                                <li><a href="https://twitter.com/Kheang_Lov"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/kheang_lov/"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="https://www.facebook.com/lovsokheang"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCMYBSHJy4UWVpJoTDh50ZpA?view_as=subscriber"><i class="zmdi zmdi-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Start Copyright Area -->
                    <div class="htc__copyright__area">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="copyright__inner">
                                    <div class="copyright" style="display: inline;">
                                        © <span id="cpyr_year"></span>, Made with
                                        <div style="display: inline;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart stroke-current text-danger w-6 h-6" style="vertical-align: top;">
                                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                            </svg>
                                        </div>
                                        by KHEANG
                                    </div>
                                    <ul class="footer__menu">
                                        <li><a href="{{ route('admin_dashboard') }}">Admin</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Copyright Area -->
                </div>
            </footer>
            <!-- End Footer Area -->
        </div>
        <!-- Body main wrapper end -->
        <!-- QUICKVIEW PRODUCT -->
        <div id="quickview-wrapper">
            <!-- Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal__container" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-product">
                                <!-- Start product images -->
                                <div class="product-images">
                                    <div class="main-image images">
                                        <img alt="big images" src="images/product/big-img/1.jpg">
                                    </div>
                                </div>
                                <!-- end product images -->
                                <div class="product-info">
                                    <h1>Simple Fabric Bags</h1>
                                    <div class="rating__and__review">
                                        <ul class="rating">
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                        </ul>
                                        <div class="review">
                                            <a href="#">4 customer reviews</a>
                                        </div>
                                    </div>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            <span class="new-price">$17.20</span>
                                            <span class="old-price">$45.00</span>
                                        </div>
                                    </div>
                                    <div class="quick-desc">
                                        Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                                    </div>
                                    <div class="select__color">
                                        <h2>Select color</h2>
                                        <ul class="color__list">
                                            <li class="red"><a title="Red" href="#">Red</a></li>
                                            <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                            <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                            <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        </ul>
                                    </div>
                                    <div class="select__size">
                                        <h2>Select size</h2>
                                        <ul class="color__list">
                                            <li class="l__size"><a title="L" href="#">L</a></li>
                                            <li class="m__size"><a title="M" href="#">M</a></li>
                                            <li class="s__size"><a title="S" href="#">S</a></li>
                                            <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                            <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                        </ul>
                                    </div>
                                    <div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
                                            <ul class="social-icons">
                                                <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                                <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                                <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                                <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                                <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="addtocart-btn">
                                        <a href="#">Add to cart</a>
                                    </div>
                                </div><!-- .product-info -->
                            </div><!-- .modal-product -->
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div>
            <!-- END Modal -->
        </div>
    </div>
    <!-- END QUICKVIEW PRODUCT -->
    <!-- Placed js at the end of the document so the pages load faster -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=373794453282051&autoLogAppEvents=1"></script>

    <!-- jquery latest version -->
    <script src="{{ asset('js/vendor/jquery-1.12.0.min.js') }}"></script>
    <!-- Bootstrap framework js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Waypoints.min.js. -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>

    <script>
        const footerYear = document.getElementById('cpyr_year');
        if (footerYear) {
            const current_date = new Date()
            const cmm = current_date.getFullYear()
            footerYear.innerText = cmm;
        }
    </script>
</body>
</html>
