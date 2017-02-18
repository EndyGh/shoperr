@extends('client.common.layout')

@section('content')

    <div class="container">
        <div class="row cart-breadcrumb">
            {!! Breadcrumbs::render('cart') !!}
        </div>
        <h1>Ваша корзина</h1>

        <hr>

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        <section id="cart-page">
            <div class="container">
                @include('client.catalog.cart-content')
                <!-- ========================================= SIDEBAR ========================================= -->

                    @if (sizeof(Cart::content()) > 0)  <div class="col-xs-12 col-md-3 no-margin sidebar ">
                    <div class="widget cart-summary">
                        <h1 class="border">Корзина товаров</h1>
                        <div class="body">
                            <ul class="tabled-data no-border inverse-bold">
                                <li>
                                    <label>Сумма заказа</label>
                                    <div class="value pull-right">{{ Cart::instance('default')->subtotal() }} грн</div>
                                </li>
                                <li>
                                    <label>ПДВ</label>
                                    <div class="value pull-right">{{ Cart::instance('default')->tax() }} грн</div>
                                </li>
                            </ul>
                            <ul id="total-price" class="tabled-data inverse-bold no-border">
                                <li>
                                    <label>Итого</label>
                                    <div class="value pull-right">{{Cart::instance('default')->total()}} грн</div>
                                </li>
                            </ul>
                            <div class="buttons-holder">
                                <a class="le-button big" href="{{route('checkout.index')}}">Оформить заказ</a>
                                <a class="simple-link block" href="{{route('index')}}">Продолжить покупки</a>
                            </div>
                        </div>
                    </div><!-- /.widget -->
                </div><!-- /.sidebar -->
                   <div class="col-xs-12 no-margin">
                       <a href="{{ route('index') }}" class="le-button big">Продолжить покупки</a> &nbsp;
                       <a href="{{route('checkout.index')}}" class="le-button big checkout" style="background-color: #00a7d0;">Оформить заказ</a>

                       <div style="float:right;margin-top:10px;">
                           <form action="{{ url('/emptyCart') }}" method="POST">
                               {!! csrf_field() !!}
                               <input type="hidden" name="_method" value="DELETE">
                               <input type="submit" class="le-button big btn-danger-custom" value="Очистить корзину">
                           </form>
                       </div>
                   </div>
                    @endif

                <!-- ========================================= SIDEBAR : END ========================================= -->
            </div>
        </section>

        <div class="spacer"></div>

    </div> <!-- end container -->

@endsection

@section('scripts')
    <script>
        (function(){

            $('.switchToWishList').click(function(e){
                e.preventDefault();
                var targetForm = $("form.switch-form[data-id="+"'"+$(this).data('target')+"'");
                $("input[type='submit']",targetForm).click();
            });

        })();

    </script>
    @include('client.catalog.counter-script',['is_cart_page'=>true])
@endsection