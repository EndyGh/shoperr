@extends("admin.common.layout")

@section("header_assets")
    <link href="{{asset("assets/bower_components/bootstrap-fileinput/css/fileinput.min.css")}}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section("content")
    <div class="container">
        <form action="{{route('product.downLoadExcel','xls')}}" style="float: left;margin-right: 10px;">
            {{csrf_field()}}
            <input type="submit" class="btn btn-success" value="Скачать Excel xls">
        </form>
        <form action="{{route('product.downLoadExcel','xlsx')}}" style="float: left;margin-right: 10px;">
            {{csrf_field()}}
            <input type="submit" class="btn btn-success" value="Скачать Excel xlsx">
        </form>
        <form action="{{route('product.downLoadExcel','csv')}}" style="float: left;">
            {{csrf_field()}}
            <input type="submit" class="btn btn-success" value="Скачать Excel csv">
        </form>
        <div style="clear: both;"></div>
        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('product.importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input id="file-input" type="file" name="import_file" />
            <br>
            <button class="btn btn-primary" type="submit">Импортировать файл</button>
        </form>
    </div>
@endsection

@section("scripts")
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/plugins/sortable.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/plugins/purify.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/fileinput.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/themes/fa/theme.js")}}" type="text/javascript"></script>
    <script>$('#file-input').fileinput()</script>
@endsection