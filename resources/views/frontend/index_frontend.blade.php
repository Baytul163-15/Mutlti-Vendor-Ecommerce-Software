<?php use App\Models\Product; ?>

@extends('frontend.front_master')
@section('content')
<!-- Main-Slider -->
<div class="default-height ph-item">
    <div class="slider-main owl-carousel">
        @foreach($slidersBanner as $slider)
        <div class="bg-image">
            <div class="slide-content">
                <h1><a @if(!empty($slider['link'])) href="{{ url($slider['link']) }}" @else href="javascript:;" @endif><img title="{{ $slider['title'] }}" alt="{{ $slider['alt'] }}" src="{{ asset('frontend/images/banners/'.$slider['slider_image']) }}"></h1></a>
                <h2>{{ $slider['title'] }}</h2>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Main-Slider /- -->

@if(isset($fixBanner[0]['slider_image']))
<!-- Banner-Layer -->
<div class="banner-layer">
    <div class="container">
        <div class="image-banner">
            <a target="_blank" rel="nofollow" href="{{ url($fixBanner[0]['link']) }}" class="mx-auto banner-hover effect-dark-opacity">
            <img class="img-fluid" src="{{ asset('frontend/images/banners/'.$fixBanner[0]['slider_image']) }}" alt="{{ $fixBanner[0]['alt'] }}" title="{{ $fixBanner[0]['title'] }}">
            </a>
        </div>
    </div>
</div>
<!-- Banner-Layer /- -->
@endif
<!-- Top Collection -->
<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <h3 class="sec-maker-h3">TOP COLLECTION</h3>
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#men-latest-products">New Arrivals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#men-best-selling-products">Best Sellers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#discounted-products">Discounted Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#men-featured-products">Featured Products</a>
                </li>
            </ul>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="men-latest-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($newProducts as $product)
                                <?php
                                    $product_image_path = 'admin/images/products_images/small_image/'.$product['product_image'];
                                ?>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/'.$product['id']) }}">
                                        @if(!empty($product['product_image']) && file_exists($product_image_path))    
                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['meta_title'] }}">
                                        @else
                                        <img class="img-fluid" src="{{ asset('admin/images/common_image/no-photo.jpg') }}" alt="{{ $product['meta_title'] }}">
                                        @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('product/'.$product['id']) }}">{{ $product['product_code'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('product/'.$product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>
                                        <?php $getDiscountPrice = Product::getDiscountPrice($product['id']); ?>
                                        @if($getDiscountPrice > 0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Tk.{{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                Tk.{{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Tk.{{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>NEW</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane show fade" id="men-best-selling-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach($bestSeller as $product)
                                <?php
                                    $product_image_path = 'admin/images/products_images/small_image/'.$product['product_image'];
                                ?>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/'.$product['id']) }}">
                                        @if(!empty($product['product_image']) && file_exists($product_image_path))    
                                        <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="{{ $product['meta_title'] }}">
                                        @else
                                        <img class="img-fluid" src="{{ asset('admin/images/common_image/no-photo.jpg') }}" alt="{{ $product['meta_title'] }}">
                                        @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('product/'.$product['id']) }}">{{ $product['product_code'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('product/'.$product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>
                                        <?php $getDiscountPrice = Product::getDiscountPrice($product['id']); ?>
                                        @if($getDiscountPrice > 0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Tk.{{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                Tk.{{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Tk.{{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>NEW</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discounted-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag sale">
                                        <span>SALE</span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name
                                                </a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag discount">
                                        <span>-15%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="men-featured-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag sale">
                                        <span>SALE</span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                        <img class="img-fluid" src="{{ asset('frontend/images/product/product@3x.jpg') }}" alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look
                                            </a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="shop-v1-root-category.html">Product Code</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Product Name
                                                </a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                $100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag discount">
                                        <span>-15%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Collection /- -->
@if(isset($fixBanner[1]['slider_image']))
<!-- Banner-Layer -->
<div class="banner-layer">
    <div class="container">
        <div class="image-banner">
            <a target="_blank" rel="nofollow" href="{{ url($fixBanner[1]['link']) }}" class="mx-auto banner-hover effect-dark-opacity">
            <img class="img-fluid" src="{{ asset('frontend/images/banners/'.$fixBanner[1]['slider_image']) }}" alt="{{ $fixBanner[1]['alt'] }}" title="{{ $fixBanner[1]['title'] }}">
            </a>
        </div>
    </div>
</div>
<!-- Banner-Layer /- -->
@endif
<!-- Site-Priorities -->
<section class="app-priority">
    <div class="container">
        <div class="priority-wrapper u-s-p-b-80">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-star"></i>
                        </div>
                        <h2>
                            Great Value
                        </h2>
                        <p>We offer competitive prices on our 100 million plus product range</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-cash"></i>
                        </div>
                        <h2>
                            Shop with Confidence
                        </h2>
                        <p>Our Protection covers your purchase from click to delivery</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-ios-card"></i>
                        </div>
                        <h2>
                            Safe Payment
                        </h2>
                        <p>Pay with the world’s most popular and secure payment methods</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-contacts"></i>
                        </div>
                        <h2>
                            24/7 Help Center
                        </h2>
                        <p>Round-the-clock assistance for a smooth shopping experience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Site-Priorities /- -->

@endsection