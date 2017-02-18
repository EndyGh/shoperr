<!DOCTYPE html>
<html itemscope="itemscope" itemtype="http://schema.org/WebPage">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset("assets/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- Range Slider -->
    <link rel="stylesheet" href="{{asset('assets/bower_components/ion.rangeSlider/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bower_components/ion.rangeSlider/css/ion.rangeSlider.skinHTML5.css')}}">
    <script src="{{asset('assets/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bower_components/bootstrap-sweetalert/dist/sweetalert.css')}}">
    @yield('css')

</head>
<body>
<div id="wrapper">
    <!-- Nav-bar -->
    <nav class="top-bar animate-dropdown">
        <div class="container">
            <div class="col-xs-12 col-sm-10 no-margin">
               @include('client.common.pages')
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-2 no-margin">
                <ul class="right">
                    <li><a href="{{route('register')}}">Регистрация</a></li>
                    <li><a href="{{route('login')}}">Войти</a></li>
                </ul>
            </div><!-- /.col -->
        </div><!-- /.container -->
    </nav>
    <!-- HEADER -->
     @include('client.common.header')
    <div class="entry-content" itemprop="mainContentOfPage">
        @yield('content')
    </div>
    <!-- ============================================================= FOOTER ============================================================= -->
    @include('client.common.footer')
    <!-- ============================================================= END OF FOOTER ============================================================= -->
</div>

<!-- jQuery -->
<script src="{{asset("assets/bower_components/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("assets/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous">
</script>
<!-- ION SLIDER -->
<script src="{{asset('assets/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
<script>

    $(document).on('click', '.yamm .dropdown-menu', function(e) {
        e.stopPropagation()
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.close-btn').click(function(e){
        e.preventDefault();
        var targetForm = $("form.delete[data-id="+"'"+$(this).data('target')+"'");
        $("input[type='submit']",targetForm).click();
    });

</script>
@yield('scripts')
@if(session()->has('order-message'))
    <script>
        swal("Статус Заказа!", "Ваш Заказ Оформлен!", "success")
    </script>
@endif
</body>
</html>