<div class="row">
    <div class="product-grid-holder">
        @foreach($products as $product)
            <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                <div class="product-item col-xs-12 col-sm-12">

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
                        <div class="price-current">{{$product->price_uah}} грн</div>
                    </div>
                    <div class="hover-area">
                        <div class="add-cart-button">
                            <a href="{{route('product.single',$product->name)}}" class="le-button">add to cart</a>
                        </div>
                        {!! HtmlEx::wishListCompare('#todoThisLink','#todoCompare') !!}
                    </div>
                </div>
                <!-- ./col-3 -->
            </div>
        @endforeach
    </div>
</div> <!--- ./row-products -->
