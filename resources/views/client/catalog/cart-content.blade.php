<!-- ========================================= CONTENT ========================================= -->
@if (sizeof(Cart::content()) > 0)
    @foreach (Cart::content() as $item)
        <div class="col-xs-12 col-md-9 items-holder no-margin">
            <div class="row no-margin cart-item">
                <div class="col-xs-12 col-sm-2 no-margin">
                    <a href="#" class="thumb-holder">
                        <img class="lazy" alt="" src="{{$item->options->image}}">
                    </a>
                </div>

                <div class="col-xs-12 col-sm-5 ">
                    <div class="title">
                        {{-- $item->model->name --}}
                        <a href="{{ route('product.single', [$item->name]) }}">{{ $item->name }}</a>
                    </div>
                    {{--  <div class="brand">{{$product_brands}}</div> --}}
                </div>

                <div class="col-xs-12 col-sm-2 no-margin">
                    <div class="quantity">
                        <div class="le-quantity">
                            <form data-id="{{ $item->rowId }}">
                                <a class="minus" href="#reduce"></a>
                                <input name="quantity" type="text" value="{{ $item->qty }}" class="quantity_input">
                                <a class="plus" href="#add"></a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-2 no-margin">
                    <div class="price">
                        {{ $item->subtotal }} грн
                    </div>
                    <a href="#" class="close-btn" data-target="{{$item->rowId}}"></a>
                    <a href="#" class="switchToWishList" data-target="{{$item->rowId}}"><i class="fa fa-heart"></i>Отправить в список желаний</span> </a>
                    <form action="{{ url('cart', [$item->rowId]) }}" data-id="{{$item->rowId}}" method="POST" class="side-by-side delete" style="display: none;">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                    </form>
                    <form action="{{ url('switchToWishlist', [$item->rowId]) }}" data-id="{{$item->rowId}}" method="POST" class="side-by-side switch-form" style="display: none;">
                        {!! csrf_field() !!}
                        <input type="submit" class="btn btn-success btn-sm" value="To Wishlist">
                    </form>
                </div>
            </div><!-- /.cart-item -->
        </div>
    @endforeach
@else
    <div class="text-center">
        <p class="cart-empty">Нет товаров в корзине</p>
        <hr>
        <p class="return-to-shop">
            <a href="{{ route('index') }}" class="button wc-backward">Продолжить покупки</a>
        </p>
    </div>
    @endif

            <!-- ========================================= CONTENT : END ========================================= -->