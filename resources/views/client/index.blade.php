@extends('client.common.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/bower_components/owl.carousel/dist/assets/owl.carousel.min.css')}}">
@endsection

@section('content')

    <!-- TOP BANNER -->
    <div id="top-banner-and-menu">
        <div class="container">
          <div class="row">
              <div class="col-xs-12 single-breadcrumb">
                  {!! Breadcrumbs::render('index') !!}
              </div>
          </div>
            <div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
                <!-- ================================== TOP NAVIGATION ================================== -->
                <div class="side-menu animate-dropdown">
                    <div class="head"><i class="fa fa-list"></i> Все категории</div>
                    <nav class="yamm megamenu-horizontal" role="navigation">
                        <ul class="nav">
                            @include('client.common.main-sidebar')
                        </ul><!-- /.nav -->
                    </nav><!-- /.megamenu-horizontal -->
                </div><!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder">
                @if($slider->slides->count())
                <div id="owl-main" class="owl-carousel owl-drag">
                    @foreach($slider->slides  as $slide)
                        <div class="item" style="background-image: url('{{$slide->image}}');">
                            <div class="container-fluid">
                                <div class="caption vertical-center text-left">
                                    <div class="big-text fadeInDown-1 col-xs-12" style="word-wrap:break-word;">
                                      <p>{!! $slide->text !!}</p>
                                    </div>
                                    <!--
                                    <div class="big-text fadeInDown-1">
                                        Save up to a<span class="big"><span class="sign">$</span>400</span>
                                    </div>

                                    <div class="excerpt fadeInDown-2">
                                        on selected laptops<br>
                                        &amp; desktop pcs or<br>
                                        smartphones
                                    </div>
                                    <div class="small fadeInDown-2">
                                        terms and conditions apply
                                    </div> -->
                                    <div class="button-holder fadeInDown-3">
                                        <a href="{{$slide->link}}" class="big le-button ">Купить сейчас</a>
                                    </div>
                                </div><!-- /.caption -->
                            </div>
                        </div>
                    @endforeach
                   <!-- <div class="item" style="background-image: url('https://transvelo.github.io/mediacenter-html/assets/images/sliders/slider03.jpg');">
                        <div class="container-fluid">
                            <div class="caption vertical-center text-left">
                                <div class="big-text fadeInDown-1">
                                    Want a<span class="big"><span class="sign">$</span>200</span>Discount?
                                </div>

                                <div class="excerpt fadeInDown-2">
                                    on selected <br>desktop pcs<br>
                                </div>
                                <div class="small fadeInDown-2">
                                    terms and conditions apply
                                </div>
                                <div class="button-holder fadeInDown-3">
                                    <a href="single-product.html" class="big le-button ">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div> <!-- Carousel -->
            @else
               @include('client.products.random')
            @endif
            </div>
        </div>
    </div>
    <!-- TOP BANNER -->
    <!-- HOME BANNERS -->
   @include('client.banners.banner')
    <!-- /.HOME BANNERS -->
    <!-- PRODUCTS BLOCK -->
    <div id="products-tab" class="wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="tab-holder">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class=""><a href="#featured" data-toggle="tab" aria-expanded="false">featured</a></li>
                    <li class=""><a href="#new-arrivals" data-toggle="tab" aria-expanded="false">new arrivals</a></li>
                    <li class="active"><a href="#top-sales" data-toggle="tab" aria-expanded="true">top sales</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="featured">
                        <div class="product-grid-holder">
                            <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-01.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount green">-50% sale</div>
                                        <div class="title">
                                            <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                        </div>
                                        <div class="brand">sony</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>

                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon blue"><span>new!</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-02.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">White lumia 9001</a>
                                        </div>
                                        <div class="brand">nokia</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">

                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-03.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">POV Action Cam</a>
                                        </div>
                                        <div class="brand">sony</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="ribbon green"><span>bestseller</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-04.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">Netbook Acer TravelMate
                                                B113-E-10072</a>
                                        </div>
                                        <div class="brand">acer</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="new-arrivals">
                        <div class="product-grid-holder">

                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon blue"><span>new!</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-02.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">White lumia 9001</a>
                                        </div>
                                        <div class="brand">nokia</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-01.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount green">-50% sale</div>
                                        <div class="title">
                                            <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                        </div>
                                        <div class="brand">sony</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>

                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="ribbon green"><span>bestseller</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-04.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">Netbook Acer TravelMate
                                                B113-E-10072</a>
                                        </div>
                                        <div class="brand">acer</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">

                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-03.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">POV Action Cam</a>
                                        </div>
                                        <div class="brand">sony</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="tab-pane active" id="top-sales">
                        <div class="product-grid-holder">

                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="ribbon green"><span>bestseller</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-04.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">Netbook Acer TravelMate
                                                B113-E-10072</a>
                                        </div>
                                        <div class="brand">acer</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">

                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-03.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">POV Action Cam</a>
                                        </div>
                                        <div class="brand">sony</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon blue"><span>new!</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-02.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">White lumia 9001</a>
                                        </div>
                                        <div class="brand">nokia</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-01.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount green">-50% sale</div>
                                        <div class="title">
                                            <a href="single-product.html">VAIO Fit Laptop - Windows 8 SVF14322CXW</a>
                                        </div>
                                        <div class="brand">sony</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-prev">$1399.00</div>
                                        <div class="price-current pull-right">$1199.00</div>
                                    </div>

                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                                            <a class="btn-add-to-compare" href="#">compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.PRODUCTS BLOCK -->
    <!-- ========================================= BEST SELLERS ========================================= -->
    <section id="bestsellers" class="color-bg wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <h1 class="section-title">Best Sellers</h1>
            <div class="row">
                <div class="product-grid-holder medium col-md-6">
                    <div class="col-xs-12 no-margin">

                        <div class="row no-margin">
                            <div class="col-xs-12 col-sm-4  no-margin product-item-holder size-medium hover">
                                <div class="product-item">
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-05.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">beats studio headphones official one</a>
                                        </div>
                                        <div class="brand">beats</div>
                                    </div>
                                    <div class="prices">

                                        <div class="price-current text-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">Add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>
                                            <a class="btn-add-to-compare" href="#">Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.product-item-holder -->

                            <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                                <div class="product-item">
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-06.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">playstasion 4 with four games and pad</a>
                                        </div>
                                        <div class="brand">acer</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-current text-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">Add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>
                                            <a class="btn-add-to-compare" href="#">Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.product-item-holder -->

                            <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                                <div class="product-item">
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-07.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">EOS rebel t5i DSLR Camera with 18-55mm IS STM lens</a>
                                        </div>
                                        <div class="brand">canon</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-current text-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">Add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>
                                            <a class="btn-add-to-compare" href="#">Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.product-item-holder -->
                        </div><!-- /.row -->

                        <div class="row no-margin">

                            <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                                <div class="product-item">
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-08.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">fitbit zip wireless activity tracker - lime</a>
                                        </div>
                                        <div class="brand">fitbit zip</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-current text-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">Add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>
                                            <a class="btn-add-to-compare" href="#">Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.product-item-holder -->

                            <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                                <div class="product-item">
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-09.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">PowerShot elph 115 16MP digital camera</a>
                                        </div>
                                        <div class="brand">canon</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-current text-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">Add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>
                                            <a class="btn-add-to-compare" href="#">Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.product-item-holder -->

                            <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                                <div class="product-item">
                                    <div class="image">
                                        <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-10.jpg">
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="single-product.html">netbook acer travelMate b113-E-10072</a>
                                        </div>
                                        <div class="brand">acer</div>
                                    </div>
                                    <div class="prices">
                                        <div class="price-current text-right">$1199.00</div>
                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="single-product.html" class="le-button">Add to cart</a>
                                        </div>
                                        <div class="wish-compare">
                                            <a class="btn-add-to-wishlist" href="#">Add to Wishlist</a>
                                            <a class="btn-add-to-compare" href="#">Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.product-item-holder -->

                        </div><!-- /.row -->
                    </div><!-- /.col -->
                </div><!-- /.product-grid-holder -->
                <div class="col-xs-12 col-md-6 no-margin">
                    <div class="single-product-gallery-item">
                        <a data-rel="prettyphoto" href="https://transvelo.github.io/mediacenter-html/assets/images/products/product-gallery-01.jpg">
                            <img alt="" src="https://transvelo.github.io/mediacenter-html/assets/images/products/product-gallery-01.jpg">
                        </a>
                        <div class="body">
                            <div class="label-discount clear"></div>
                            <div class="title">
                                <a href="single-product.html">CPU intel core i5-4670k 3.4GHz BOX B82-12-122-41</a>
                            </div>
                            <div class="brand">sony</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </section>
    <!-- ========================================= END OF BEST SELLERS ========================================= -->
    <!-- ========================================= Recently viewed ============================================= -->
    <section id="recently-reviewd" class="wow fadeInUp animated" style="display: none; animation-name: fadeInUp;">
        <div class="container">
            <div class="carousel-holder hover">
                <div class="title-nav">
                    <h2 class="h1">Вы смотрели</h2>
                </div><!-- /.title-nav -->
                <div class="products-recently"></div>
               </div>
        </div><!-- /.container -->
    </section>
    <!-- ========================================= END OF Recently viewed ============================================= -->
@endsection

@section('scripts')
    <script src="{{asset('assets/bower_components/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    <script>

        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('#owl-main').owlCarousel({
            autoplay:true,
            autoplayTimeout:3500,
            autoplayHoverPause:false,
            loop:true,
            items:1,
            nav:true
        });

        var viewed = localStorage.getItem('viewed_products');
        if(viewed) {
            $('#recently-reviewd').css('display','block');
            getRecentlyViewedProducts('{{ route('product.recently') }}',viewed);
        }

        function getRecentlyViewedProducts(route,data)
        {
            $.ajax({
                url: route,
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    'products':data
                },
                success: function (data) {
                    $('.products-recently').html(data);
                }
            });
        }
    </script>
@endsection