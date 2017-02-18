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
                    <h3 class="box-title">Добавить слайдер</h3>
                    <h4>Рекомендуемый размер изображения - 710x352</h4>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action='{{route("slider.create")}}' method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <i class="fa fa-eye" aria-hidden="true"></i><label for="slider_active">Статус слайдера</label>
                        <input type="checkbox" style="margin:3px 0 0 7px;" name="active" id="slider_active">
                        <br>
                        <label class="control-label" for="file-input">Select File</label>
                        <input id="file-input" name="slide[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
                        <div class="slides-content" style="margin:10px 0;"></div>
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
    <script>
        var index = 0;
        $('#file-input').on('fileimageloaded', function(event) {
            index++;
            var slide = '<div class="panel"> <label for="slide-text-'+index+'">Текст к '+index+' слайду</label>'+
                    ' <input type="text" class="form-control input-sm" name="slides-text[]" id="slide-text-'+index+'" style="margin-bottom: 5px;">' +
                    ' <label for="slide-text-'+index+'">Ссылка к '+index+' слайду</label>'+
                    ' <input type="text" class="form-control input-sm" name="slides-link[]" id="slide-text-'+index+'" style="margin-bottom: 5px;"></div>';
            $('.slides-content').append(slide);
        });

        $('#file-input').on('fileclear', function(event) {
            index = 0;
            $('.slides-content').empty();
        });
    </script>
@endsection