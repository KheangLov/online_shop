@extends('layouts.app', ['categories' => $categories])

@section('content')
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url('{{ asset('images/bg/2.jpg') }}') no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Larashop</h2>
                        <span class="breadcrumb-item active">Product Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Product Details -->
<section class="htc__product__details pt--120 pb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="product__details__container">
                    <!-- Start Small images -->
                    <ul class="product__small__images" role="tablist">
                        @foreach ($images as $image)
                            <li role="presentation" class="pot-small-img">
                                <a href="#img-tab-{{ $image->id }}" role="tab" data-toggle="tab">
                                    <img src="{{ asset($image->path) }}" style="width: 120px; height: 140px;" alt="small-image">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- End Small images -->
                    <div class="product__big__images">
                        <div class="portfolio-full-image tab-content">
                            @php($i = 0)
                            @foreach ($images as $image)
                                <div role="tabpanel" class="tab-pane fade in{{ $i === 0 ? ' active' : '' }} product-video-position" id="img-tab-{{ $image->id }}">
                                    <img src="{{ asset($image->path) }}" style="width: 440px; height: 590px;" alt="full-image">
                                </div>
                                @php($i++)
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                <div class="htc__product__details__inner">
                    <div class="pro__detl__title">
                        <h2>{{ $product->name }}</h2>
                    </div>
                    <ul class="pro__dtl__prize">
                        @if (!empty($product->discount))
                        @php($new_price = $product->price - ($product->price * $product->discount) / 100)
                            <li class="old__prize">${{ $product->price }}</li>
                            <li>${{ $new_price }}</li>
                        @else
                            <li>${{ $product->price }}</li>
                        @endif
                    </ul>
                    @if (count($product->productVariants) > 0)
                        @if (isset($product->productVariants[0]->color))
                            <div class="pro__dtl__color">
                                <h2 class="title__5">Choose Colour</h2>
                                <select name="" id="" style="width: 25%;">
                                    @foreach ($product->productVariants as $pv)
                                        <option value="{{ $pv->color }}">{{ $pv->color }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if (isset($product->productVariants[0]->size))
                            <div class="pro__dtl__size">
                                <h2 class="title__5">Size</h2>
                                <select name="" id="" style="width: 25%;">
                                    @foreach ($product->productVariants as $pv)
                                        <option value="{{ $pv->size }}">{{ $pv->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endif
                    <div class="product-action-wrap">
                        <div class="prodict-statas"><span>Quantity :</span></div>
                        <div class="product-quantity">
                            <div class="product-quantity">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="pro__dtl__btn">
                        <li class="buy__now__btn"><a href="#">add to cart</a></li>
                        <li><a href="#"><span class="ti-heart"></span></a></li>
                        <li><a href="#"><span class="ti-email"></span></a></li>
                    </ul>
                    <div class="pro__social__share">
                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Details -->
<!-- Start Product tab -->
<section class="htc__product__details__tab bg__white pb--120">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <ul class="product__deatils__tab mb--60" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#description" role="tab" data-toggle="tab">Description</a>
                    </li>
                    <li role="presentation">
                        <a href="#related_pro" role="tab" data-toggle="tab">Related products</a>
                    </li>
                    <li role="presentation">
                        <a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product__details__tab__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="product__tab__content fade in active">
                        <div class="product__description__wrap">
                            <div class="product__desc">
                                <h2 class="title__6">Details</h2>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Content -->
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="related_pro" class="product__tab__content fade">
                        <div class="pro__feature">
                                <h2 class="title__6">Products</h2>
                                <ul class="feature__list">
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Duis aute irure dolor in reprehenderit in voluptate velit esse</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Irure dolor in reprehenderit in voluptate velit esse</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Irure dolor in reprehenderit in voluptate velit esse</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Sed do eiusmod tempor incididunt ut labore et </a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Sed do eiusmod tempor incididunt ut labore et </a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Nisi ut aliquip ex ea commodo consequat.</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Nisi ut aliquip ex ea commodo consequat.</a></li>
                                </ul>
                            </div>
                    </div>
                    <!-- End Single Content -->
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="reviews" class="product__tab__content fade">
                        <div class="review__address__inner">
                            <!-- Start Single Review -->
                            <div class="pro__review">
                                <div class="review__thumb">
                                    <img src="images/review/1.jpg" alt="review images">
                                </div>
                                <div class="review__details">
                                    <div class="review__info">
                                        <h4><a href="#">Gerald Barnes</a></h4>
                                        <ul class="rating">
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star-half"></i></li>
                                            <li><i class="zmdi zmdi-star-half"></i></li>
                                        </ul>
                                        <div class="rating__send">
                                            <a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
                                            <a href="#"><i class="zmdi zmdi-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="review__date">
                                        <span>27 Jun, 2016 at 2:30pm</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                            <!-- Start Single Review -->
                            <div class="pro__review ans">
                                <div class="review__thumb">
                                    <img src="images/review/2.jpg" alt="review images">
                                </div>
                                <div class="review__details">
                                    <div class="review__info">
                                        <h4><a href="#">Gerald Barnes</a></h4>
                                        <ul class="rating">
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star-half"></i></li>
                                            <li><i class="zmdi zmdi-star-half"></i></li>
                                        </ul>
                                        <div class="rating__send">
                                            <a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
                                            <a href="#"><i class="zmdi zmdi-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="review__date">
                                        <span>27 Jun, 2016 at 2:30pm</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                        </div>
                        <!-- Start RAting Area -->
                        <div class="rating__wrap">
                            <h2 class="rating-title">Write  A review</h2>
                            <h4 class="rating-title-2">Your Rating</h4>
                            <div class="rating__list">
                                <!-- Start Single List -->
                                <ul class="rating">
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                </ul>
                                <!-- End Single List -->
                                <!-- Start Single List -->
                                <ul class="rating">
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                </ul>
                                <!-- End Single List -->
                                <!-- Start Single List -->
                                <ul class="rating">
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                </ul>
                                <!-- End Single List -->
                                <!-- Start Single List -->
                                <ul class="rating">
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                </ul>
                                <!-- End Single List -->
                                <!-- Start Single List -->
                                <ul class="rating">
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                    <li><i class="zmdi zmdi-star-half"></i></li>
                                </ul>
                                <!-- End Single List -->
                            </div>
                        </div>
                        <!-- End RAting Area -->
                        <div class="review__box">
                            <form id="review-form">
                                <div class="single-review-form">
                                    <div class="review-box name">
                                        <input type="text" placeholder="Type your name">
                                        <input type="email" placeholder="Type your email">
                                    </div>
                                </div>
                                <div class="single-review-form">
                                    <div class="review-box message">
                                        <textarea placeholder="Write your review"></textarea>
                                    </div>
                                </div>
                                <div class="review-btn">
                                    <a class="fv-btn" href="#">submit review</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product tab -->
@endsection
