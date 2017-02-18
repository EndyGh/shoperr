@extends("admin.common.layout")

@section('header_assets')
    {!! Charts::assets() !!}
@endsection

@section("content")
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <a href="{{route('product.index')}}">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-grid"></i></span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Добавить товар</span>
                    <span class="info-box-number">{{$products_count}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <a href="{{route('category.index')}}">
                    <span class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Категории</span>
                    <span class="info-box-number">{{$categories_count}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <a href="#">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                </a>

                <div class="info-box-content">
                    <span class="info-box-text">Заказы</span>
                    <span class="info-box-number">{{$orders_count}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <a href="#">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Новые пользователи</span>
                    <span class="info-box-number">{{$users_count}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class='row'>
        <div class='col-md-6'>
           <div class="row">
               {!! $usersChart->render() !!}
           </div>
            <div class="row">
                {!! $ordersChart->render() !!}
            </div>
        </div><!-- /.col -->
        <div class='col-md-6'>
            <h3 class="box-title">Свединия о системе {{"(Laravel -  ".app()->version()." )"}}</h3>
            @include('admin.parts.phpinfo')
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection