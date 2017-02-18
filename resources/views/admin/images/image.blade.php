@extends("admin.common.layout")

@section("header_assets")
    <link href="{{asset("assets/bower_components/bootstrap-fileinput/css/fileinput.min.css")}}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section("content")
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Images</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action='{{route("image.create")}}' method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label class="control-label" for="file-input">Select File</label>
                        <input id="file-input" name="image[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
                        <br>
                        <input type="submit" class="btn btn-success">
                    </form>
                </div><!-- /.box-body -->
                <div class="box-footer"></div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


@section("scripts")
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/plugins/sortable.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/plugins/purify.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/js/fileinput.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/bower_components/bootstrap-fileinput/themes/fa/theme.js")}}" type="text/javascript"></script>
@endsection