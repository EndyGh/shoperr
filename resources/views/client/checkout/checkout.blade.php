@extends('client.common.layout')

@section('content')
    <section id="checkout-page">
        <div class="container">
            <form action="{{route('checkout.store')}}" method="POST">
                {{csrf_field()}}
                <div class="col-xs-12 no-margin">

                    <div class="billing-address">
                        <h2 class="border h1">Оформление заказа</h2>
                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                @if($errors->has('first_name'))
                                    <label class="label-error">Введите имя</label>
                                    @else
                                    <label>Имя</label>
                                @endif
                                <input class="le-input @if($errors->has('first_name')){{'field-has-error'}}@endif" name="first_name">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @if($errors->has('last_name'))
                                    <label class="label-error">Введите фамилию</label>
                                @else
                                    <label>Фамилия</label>
                                @endif
                                <input class="le-input @if($errors->has('last_name')){{'field-has-error'}}@endif" name="last_name">
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12">
                                @if($errors->has('city'))
                                    <label class="label-error">Введите город</label>
                                @else
                                    <label>Город</label>
                                @endif
                                <input class="le-input placeholder @if($errors->has('city')){{'field-has-error'}}@endif" data-placeholder="Адресс" name="city">
                            </div>
                        </div><!-- /.field-row -->

                        <div class="row field-row">
                            <div class="col-xs-12 col-sm-6">
                                @if($errors->has('city'))
                                    <label class="label-error">Введите почту</label>
                                @else
                                    <label>Почта</label>
                                @endif
                                <input  type="email" class="le-input @if($errors->has('email')){{'field-has-error'}}@endif" name="email">
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                @if($errors->has('phone'))
                                    <label class="label-error">Введите номер</label>
                                @else
                                    <label>Номер телефона</label>
                                @endif
                                <input class="le-input @if($errors->has('phone')){{'field-has-error'}}@endif" pattern="[0-9]{3}\s[0-9]{2}\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}" name="phone"
                                       placeholder="380 25 515 85 38" title="Формат ввода 380 25 515 85 38" required/>
                            </div>
                        </div><!-- /.field-row -->

                        {{-- <div class="row field-row">
                            <div id="create-account" class="col-xs-12">
                                <input class="le-checkbox big" type="checkbox"><i class="fake-box"></i>
                                <a class="simple-link bold" href="#">Create Account?</a> - you will receive email with temporary generated password after login you need to change it.
                            </div>
                        </div><!-- /.field-row --> --}}
                    </div><!-- /.billing-address -->

                    <section id="shipping">
                        <h2 class="border h1">Адрес доставки</h2>
                        <div class="row field-row">
                            <div class="col-xs-12">
                                @if($errors->has('shipping_address'))
                                    <label class="label-error">Введите адресс</label>
                                @else
                                    <label>Адресс доставки</label>
                                @endif
                                <input class="le-input placeholder @if($errors->has('shipping_address')){{'field-has-error'}}@endif" data-placeholder="Адресс" name="shipping_address">
                            </div>
                        </div><!-- /.field-row -->
                    </section><!-- /#shipping-address -->


                    <section id="your-order">
                        <h2 class="border h1">Ваш заказ</h2>
                        @if (sizeof(Cart::content()) > 0)
                        @foreach (Cart::content() as $item)
                                <!-- order-item -->
                        <div class="row no-margin order-item">
                            <div class="col-xs-12 col-sm-1 no-margin">
                                <a href="#" class="qty">{{$item->qty}} x</a>
                            </div>

                            <div class="col-xs-12 col-sm-9 ">
                                <div class="title"><a href="#">{{$item->name}} </a></div>
                                {{--   <div class="brand">sony</div> --}}
                            </div>

                            <div class="col-xs-12 col-sm-2 no-margin">
                                <div class="price">{{ $item->subtotal }} грн</div>
                            </div>
                        </div><!-- /.order-item -->

                        @endforeach
                        @endif
                    </section><!-- /#your-order -->

                    <div id="total-area" class="row no-margin">
                        <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                            <div id="subtotal-holder">
                                <ul class="tabled-data inverse-bold no-border">
                                    <li>
                                        <label>Сумма заказа</label>
                                        <div class="value ">{{ Cart::instance('default')->subtotal() }} грн</div>
                                    </li>
                                    <li>
                                        <label>ПДВ</label>
                                        <div class="value ">{{ Cart::instance('default')->tax() }} грн</div>
                                    </li>
                                    {{-- <li>
                                         <label>shipping</label>
                                         <div class="value">
                                             <div class="radio-group">
                                                 <input class="le-radio" type="radio" name="group1" value="free"><i class="fake-box"></i> <div class="radio-label bold">free shipping</div><br>
                                                 <input class="le-radio" type="radio" name="group1" value="local" checked=""><i class="fake-box"></i>  <div class="radio-label">local delivery<br><span class="bold">$15</span></div>
                                             </div>
                                         </div>
                                     </li> --}}
                                </ul><!-- /.tabled-data -->

                                <ul id="total-field" class="tabled-data inverse-bold ">
                                    <li>
                                        <label>Итого</label>
                                        <div class="value">{{ Cart::instance('default')->total() }} грн</div>
                                    </li>
                                </ul><!-- /.tabled-data -->

                            </div><!-- /#subtotal-holder -->
                        </div><!-- /.col -->
                    </div><!-- /#total-area -->

                    {{--  <div id="payment-method-options">
                         <form>
                             <div class="payment-method-option">
                                 <input class="le-radio" type="radio" name="group2" value="Direct"><i class="fake-box"></i>
                                 <div class="radio-label bold ">Direct Bank Transfer<br>
                                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum tempus elit, vestibulum vestibulum erat ornare id.</p>
                                 </div>
                             </div><!-- /.payment-method-option -->

                             <div class="payment-method-option">
                                 <input class="le-radio" type="radio" name="group2" value="cheque"><i class="fake-box"></i>
                                 <div class="radio-label bold ">cheque payment</div>
                             </div><!-- /.payment-method-option -->

                             <div class="payment-method-option">
                                 <input class="le-radio" type="radio" name="group2" value="paypal"><i class="fake-box"></i>
                                 <div class="radio-label bold ">paypal system</div>
                             </div><!-- /.payment-method-option -->
                         </form>
                     </div><!-- /#payment-method-options --> --}}

                    <div class="place-order-button">
                        <input type="submit" class="le-button big" value="Оформить заказ">
                    </div><!-- /.place-order-button -->

                </div><!-- /.col -->
            </form>
        </div><!-- /.container -->
    </section>
@endsection