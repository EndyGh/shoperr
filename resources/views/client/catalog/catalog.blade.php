@extends('client.common.layout')

@section('css')
    <style>
        a[data-link='{{ $category->getUrl() }}'] {
            padding-right: 5px;
            background-color: #e4e4e4 !important;
        }
    </style>
@endsection

@section('content')
<!-- TOP BANNER -->
<div id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                {!! Breadcrumbs::render('catalog',$category) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
            <div class="widget">
                <h1>Фильтр товаров</h1>
                <hr>
                <form action="{{ route('catalog.filter',$category->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="body bordered" style="margin-top:-20px;">
                        <div class="category-filter">
                            <h2>Бренды</h2>
                            <ul>
                                @foreach($brands as $brand)
                                    <div class="checkbox checkbox-primary">
                                        <input id="brand-{{$brand->name}}" class="styled" type="checkbox" name="brands[]" value="{{$brand->id}}">
                                        <label for="brand-{{$brand->name}}">
                                            {{$brand->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.category-filter -->
                        <div class="price-filter">
                            <h2>Цена</h2>
                            <div class="price-range-holder">
                                <input type="text" id="product_price_uah_input" name="product_price_uah" />
                            <span class="min-max">
                                Цена от 10 грн до {{$max_price}} грн
                            </span>
                                <button class="filter-button btn pull-right" id="submit_filter">Фильтр</button>
                            </div>
                        </div>
                        <!-- /.price-filter -->
                    </div>
                    <input type="number" value="1" name="price_from" id="filter_price_from" hidden="hidden">
                    <input type="number" value="10" name="price_to" id="filter_price_to" hidden="hidden">
                    <input type="submit" value="Фильтр" hidden="hidden">
                    <!-- /.body -->
                </form>
            </div>
            <div class="widget accordion-widget category-accordions">
                <h1 class="border">Категории</h1>
                <div id="accordion" class="accordion">
                    @include('client.categories.traverse')
                </div>
                <!-- /.accordion -->
            </div>
        </div>
        <main class="col-xs-12 col-sm-8 col-md-9" role="main">
            <h1 class="page-title">{{$category->name}}</h1>
              <div class="loop-content">
                  @include('client.catalog.loop',$products)
              </div>
           @if($products->count())
                {!! $products->render('_partials.paginator') !!}
            @endif
        </main>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var input = $("#product_price_uah_input");
        var max = +"{{ $max_price }}";

        $("input[type='checkbox']").change(function(){
           $(':checked','.checkbox').not(this).prop( "checked", false );
        });
        // Activate plugin
        $(input).ionRangeSlider({
            type: "double",
            min: 0,
            max: max+15,
            from: 0,
            to: max+1,
            grid: true,
            onFinish : function (data) {
                var from = data.from,to = data.to;
                $('#filter_price_from').val(from);
                $('#filter_price_to').val(to);
            }
        });

        // Saving it's instance to var
        var slider = $(input).data("ionRangeSlider");

        // Fire public method
       // slider.reset();

        var f = function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            var data = form.serialize();
            animateContent(function(){
                $.post(form.attr('action'), data,function( data ) {
                    $('.loop-content').html(data);
                    $('.loop-content').animate({'opacity': '1'},250);
                });
            });
        };

        var filterRamining = localStorage.getItem('remaining-filter');
        var submitFilterBtn = $('#submit_filter');

        if(filterRamining) {
            var time = new Date().getTime();
            if(time >= +filterRamining) {
                localStorage.removeItem('remaining-filter');
                count = 0;
                submitFilterBtn.attr('disabled',false);
            } else {
                submitFilterBtn.attr('disabled',true);
            }
        }

        var count = 0;
        // Filter button listener
        submitFilterBtn.click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = btn.closest('form');
            var data = form.serializeArray();
            count++;
            if(count==8) {
                btn.attr('disabled',true);
                var time = new Date;
                time.setTime(time.getTime() + 60*1000); // add 1 minute
                localStorage.setItem('remaining-filter',time.getTime());
                setTimeout(function () {
                    count = 0;
                    localStorage.removeItem('remaining-filter'); // clear it
                    btn.attr('disabled',false);
                }, 60000);
            } else {
                $.post(form.attr('action'), data)
                        .done(function (data) {
                            animateContent(function () {
                                $('.loop-content').animate({'opacity': '0'}, 250);
                                $('.loop-content').html(data);
                            });
                        })
                        .fail(function () {
                            $('.loop-content').html('Слишком много запросов');
                        })
                        .always(function () {
                            animateContent(function () {
                                $('.loop-content').animate({'opacity': '1'}, 250);
                            });
                        });
            }
        });

        function animateContent(cb){
            if(!cb) cb = function(){};
            $('.loop-content').animate({'opacity': '0'},250,cb);
        }

        $('a','.accordion').on('dblclick',function(){
            window.location.href = $(this).data('link')
        });

    </script>
@endsection