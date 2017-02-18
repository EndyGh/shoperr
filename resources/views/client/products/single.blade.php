@extends('client.common.layout')

@section('content')
    <div id="single-product">
        <div class="container">
            @if(count($product->images))
            <div id="carousel-example-generic" class="carousel slide col-md-4" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach($product->images as $image)
                          <li data-target="#carousel-example-generic" data-slide-to="{{$loop->index}}" <?php if($loop->first) echo 'class="active"'; ?>></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach($product->images as $image)
                            <div class="item <?php if($loop->first) echo 'active'; ?>">
                                <img src="{{$image->url or asset('img/no_preview.jpg')}}" alt="Preview">
                            </div>
                        @endforeach
                    </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div> <!-- Carousel -->
                @else
              <div class="col-xs-12 col-sm-3 col-md-4">
                  <img class="img-responsive" src="{{asset('img/no_preview.jpg')}}" alt="Product preview">
                  <h3>Товар без предосмотра.</h3>
              </div>
            @endif
            <div class="no-margin col-xs-12 col-sm-7 body-holder" style="margin-top:15px;">
                <div class="body">
                    <div class="star-holder inline">
                        <div class="star star-render" data-score="4" style="cursor: pointer; width: 80px;">
                            @for ($i=1; $i <= 5 ; $i++)
                                <a href="#" class="fa fa-star{{ ($i <= round($product->rating_cache)) ? '' : '-o'}}"></a>
                            @endfor
                        </div>
                    </div>
                   @if($product->active)
                        <div class="availability"><label>Товар:</label><span class="available">  есть в наличии</span></div>
                        @else
                        <div class="availability"><label>Товар:</label><span class="not-available">  нет в наличии</span></div>
                    @endif

                    <div class="title"><a href="#">{{$product->name}}</a></div>
                    <div class="brand">{{$product->brands->name or ""}}</div>

                    <div class="excerpt">
                        <p>
                            <?php $description_anchor = str_limit($product->name,50,'.'); ?>
                            <a href="#desc-<?php echo $description_anchor ?>" class="description-anchor">{!! str_limit($product->description,100,'.')!!}</a>
                        </p>
                    </div>

                    <div class="prices">
                        <div class="price-current">{{$product->price_uah}} грн</div>
                        <div class="price-usd">${{$product->price_usd}}</div>
                    </div>

                    @if($product->active)
                    <div class="qnt-holder">
                        <div id="model-amount" data-value="{{$product->amount}}" style="display: none;"></div>
                        <div class="le-quantity">
                            <form>
                                <a class="minus" href="#reduce"></a>
                                <input name="quantity" readonly="readonly" type="text" value="1">
                                <a class="plus" href="#add"></a>
                            </form>
                        </div>
                        <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1" id="cart_product_count">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price_uah }}">
                            <input type="submit" class="btn le-button hug" value="Add to Cart">
                        </form>
                    </div><!-- /.qnt-holder -->
                    @endif
                </div><!-- /.body -->

            </div><!-- /.body-holder -->
        </div><!-- /.container -->
    </div>
    <section id="single-product-tab">
        <div class="container">
            <div class="tab-holder">

                <ul class="nav nav-tabs simple">
                    <li class="active"><a href="#description" data-toggle="tab">Описание</a></li>
                    <li><a href="#additional-info" data-toggle="tab">Дополнительная информация</a></li>
                    @can('customer-access')
                    <li><a href="#reviews" data-toggle="tab" aria-expanded="true">Отзывы ({{$reviews->count()}})</a></li>
                    @endcan
                </ul><!-- /.nav-tabs -->

                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <div id="desc-<?php echo $description_anchor ?>">
                            {!! $product->description !!}
                        </div>
                        <div class="meta-row">
                            <div class="inline">
                                <label>Код товара:</label>
                                <span>{{$product->code}}</span>
                            </div><!-- /.inline -->

                            <span class="seperator">/</span>


                            <div class="inline">
                                <label>Категории:</label>
                              @foreach($product->categories as $category)
                                    <span><a href="{{$category->getUrl()}}">{{$category->name}}</a>@if(!$loop->last),@endif</span>
                               @endforeach
                            </div><!-- /.inline -->

                            <span class="seperator">/</span>

                            <div class="inline">
                                <label>Теги:</label>
                                @foreach($product->tags as $tag)
                                    <span><a href="#{{$tag->slug}}">{{$tag->name}}</a>@if(!$loop->last),@endif</span>
                                @endforeach
                            </div><!-- /.inline -->
                        </div><!-- /.meta-row -->
                    </div><!-- /.tab-pane #description -->

                    <div class="tab-pane" id="additional-info">
                        <ul class="tabled-data">
                            <?php $properties = $product->properties;
                                $properties_has_guarantee = false;
                                $properties->each(function ($item, $key) use (&$properties_has_guarantee) {
                                    if ($item->name=="Гарантия" || $item->name=="Guarantee") {
                                        $properties_has_guarantee = true;
                                    }
                                });
                            ?>
                            @foreach($properties as $prop)
                               <li>
                                   <label>{{$prop->name}}</label>
                                   <div class="value">{{$prop->value}}</div>
                               </li>
                            @endforeach
                            @if(!$properties_has_guarantee) {{-- Property has not guarantee key --}}
                               <li>
                                 <label>Гарантия</label>
                                 <div class="value">{{$product->guarantee}}</div>
                               </li>
                            @endif
                        </ul><!-- /.tabled-data -->
                    </div><!-- /.tab-pane #additional-info -->

                    @can('customer-access')
                        <div class="tab-pane" id="reviews">
                        <div class="comments">
                            @foreach($reviews as $review)
                            <div class="comment-item">
                                <div class="row no-margin">
                                    <div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
                                        <div class="avatar">
                                            <img alt="avatar" src="{{asset('img/avatar.jpg')}}">
                                        </div><!-- /.avatar -->
                                    </div><!-- /.col -->

                                    <div class="col-xs-12 col-lg-11 col-sm-10 no-margin">
                                        <div class="comment-body">
                                            <div class="meta-info">
                                                <div class="author inline">
                                                    <a href="#" class="bold">{{$review->user->name}}</a>
                                                </div>
                                                <div class="star-holder inline">
                                                    <div class="star star-render" data-score="{{$review->rating or 0}}" style="cursor: pointer; width: 80px;">
                                                        @for ($i=1; $i <= 5 ; $i++)
                                                            <a href="#" class="fa fa-star{{ ($i <= $review->rating) ? '' : '-o'}}"></a>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="date inline pull-right">
                                                  {{$review->timeago}}
                                                </div>
                                            </div><!-- /.meta-info -->
                                            <p class="comment-text" style="word-break: break-all;">
                                                @if($review->user->hasRole('admin'))
                                                    {!! $review->comment !!}
                                                @else
                                                    {{$review->comment}}
                                                @endif
                                            </p><!-- /.comment-text -->
                                        </div><!-- /.comment-body -->

                                    </div><!-- /.col -->

                                </div><!-- /.row -->
                            </div><!-- /.comment-item -->
                          @endforeach
                        </div><!-- /.comments -->

                            <div class="col-sm-8 col-xs-12">
                                <div class="new-review-form">
                                    <h2>Оставить отзыв</h2>
                                    {{ Form::open(['route' => ['product.review.store',$product->id],'class'=>'contact-form', 'id'=>'contact-form', ]) }}

                                     {{Form::hidden('rating', 0, array('id'=>'ratings-hidden'))}}

                                        <div class="field-row star-row">
                                            <label>Рейтинг</label>
                                            <div class="star-holder">
                                                <div class="star big review-star"  style="cursor: pointer; width: 80px;"></div>
                                        </div><!-- /.field-row -->

                                        <div class="field-row">
                                            <label>Ваш отзыв</label>
                                            <div class="form-group @if($errors->has('comment')){{'has-error'}}@endif">
                                            <textarea rows="8" class="le-input form-control" style="margin: 0px; width: 722px; height: 178px;" name="comment"></textarea>
                                            </div>
                                        </div><!-- /.field-row -->

                                        <div class="buttons-holder">
                                            <button type="submit" class="le-button huge">Оставить отзыв</button>
                                        </div><!-- /.buttons-holder -->
                                        {{Form::close()}}<!-- /.contact-form -->
                                </div><!-- /.new-review-form -->
                            </div><!-- /.col -->
                        </div><!-- /.add-review -->
                    </div>
                    @endcan
                  </div>
                </div><!-- /.tab-content -->

            </div><!-- /.tab-holder -->
        </div><!-- /.container -->
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/star.js')}}"></script>
    @include('client.catalog.counter-script',['is_cart_page'=>false])
    <script>
        var product_id = '{{ $product->id}}';
        var cartForm = $('form.side-by-side');
        $(cartForm).on('submit',function(e){
            var quantity = +$('.le-quantity input').val();
            $('#cart_product_count').val(quantity);
        });


        $(".star:not(.review-star):not(.star-render)").starrr({
            readOnly: true
        });

        $('.star.review-star').starrr({
            change: function(e, value){
                 $('#ratings-hidden').val(value);
            }
        });

        $('img','.star.big').click(function(){
            var score = $(this).data('score');
            alert(score);
        });
    </script>
    <script src="{{asset('js/product-view.js')}}" defer="defer"></script>
@endsection