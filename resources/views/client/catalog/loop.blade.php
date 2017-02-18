{{-- Necessary for catalog filter ajax request --}}
@foreach($products->chunk(3) as $product_collection)
    <div class="row">
        <div class="product-grid-holder">
            @foreach($product_collection as $product)
                    <!-- col-3 -->
            <div class="product-item col-xs-12 col-sm-4">

                <div class="image">
                    <img alt="" src="{{$product->images->first()->url or asset('img/no_preview.jpg')}}">
                </div>
                <div class="body">
                    <div class="label-discount clear"></div>
                    <div class="title">
                        <a href="{{route('product.single',$product->name)}}">{{$product->name}}</a>
                    </div>
                </div>
                <div class="prices">
                    <div class="price-prev">{{$product->price_uah}} грн</div>
                    <div class="price-current pull-right">${{$product->price_usd}}</div>
                </div>
                <div class="hover-area">
                    <div class="add-cart-button">
                        <a href="{{route('product.single',$product->name)}}" class="le-button">add to cart</a>
                    </div>
                    <div class="wish-compare">
                        <a class="btn-add-to-wishlist" href="#">add to wishlist</a>
                        <a class="btn-add-to-compare" href="#">compare</a>
                    </div>
                </div>
            </div>
            <!-- ./col-3 -->
            @endforeach
        </div>
    </div> <!--- ./row-products -->
@endforeach
