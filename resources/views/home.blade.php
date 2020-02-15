@extends('layouts.app')

@section('content')
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Larashop</h2>
                        <span class="breadcrumb-item active">Homepage</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Our Product Area -->
<section class="htc__product__area shop__page ptb--130 bg__white" style="padding: 200px 0;">
    <div class="container">
        <div class="htc__product__container">
            <!-- Start Product MEnu -->
            <div class="row">
                <div class="col-md-12">
                    <div class="filter__menu__container">
                        <div class="product__menu custom-product-menu">
                            <button data-id="*" class="is-checked">All</button>
                            @foreach ($categories as $cate)
                                <button data-id="{{ $cate->id }}">{{ $cate->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Filter Menu -->
            <!-- End Product MEnu -->
            <div class="row">
                <div class="product__list another-product-style" id="shop_products">
                    @foreach ($products as $product)
                        <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                            <div class="product foo">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="{{ route('shop_product_details', ['id' => $product->id]) }}">
                                            <div class="product_img_bg" style="background-color: #666;">
                                                <img class="custom_product_thumbnail" src="{{ $product->thumbnail }}" alt="product images">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="product__hover__info">
                                        <ul class="product__action">
                                            <li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                            <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                            <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2>
                                        <a href="{{ route('shop_product_details', ['id' => $product->id]) }}" style="text-transform: capitalize;">
                                            {{ $product->name }}
                                        </a>
                                    </h2>
                                    <ul class="product__price">
                                        @if (!empty($product->discount))
                                            @php($new_price = $product->price - ($product->price * $product->discount) / 100)
                                            <li class="old__price">${{ $product->price }}</li>
                                            <li class="new__price" style="padding: 0;">${{ $new_price }}</li>
                                        @else
                                            <li class="new__price" style="padding: 0;">${{ $product->price }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
