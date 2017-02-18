@extends("admin.common.layout")

@section("header_assets")
    <link href="{{asset("assets/bower_components/bootstrap-fileinput/css/fileinput.min.css")}}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Редактировать слайдер</h3>
                    <h4>Рекомендуемый размер изображения - 710x352</h4>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @foreach($sliders as $slider)
                        <form action='{{route("slider.update",$slider->id)}}' method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <i class="fa fa-eye" aria-hidden="true"></i><label for="slider_active-{{$slider->id}}">Статус слайдера</label>
                            <input type="checkbox" @if($slider->active)checked="checked"@endif style="margin:3px 0 0 7px;" name="active" id="slider_active-{{$slider->id}}">
                            <br>
                            <label class="control-label" for="file-input">Select File</label>
                            <input id="file-input" name="slide[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
                            <div class="slides-content" style="margin:10px 0;">
                                <?php $loop_index = 0; ?>
                                @foreach($slider->slides as $slide)
                                    <?php $loop_index++ ?>
                                    <label for="slide-text-{{$loop_index}}">Текст к {{$loop_index}} слайду</label>
                                    <input type="text" class="form-control input-sm" name="slides-text[]" id="slide-text-{{$loop_index}}" style="margin-bottom: 5px;" value="{{$slide->text}}">
                                @endforeach
                            </div>
                            <input type="submit" class="btn btn-success">
                        </form>
                        <br>
                        <form action="{{route('slider.delete',$slider->id)}}" method="post">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-danger destroy-slider" value="Удалить">
                        </form>
                        <br>
                    @endforeach
                </div><!-- /.box-body -->
                <div class="box-footer">
                    {!! $sliders->links() !!}
                </div><!-- /.box-footer-->
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
            if(index == 0)  $('.slides-content').empty();
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


        $("#file-input").fileinput({
            overwriteInitial: true,
            initialPreview: [
                // IMAGE DATA
                @foreach($sliders->first()->slides as $slide)
                "{{ $slide->image }}"@if(!$loop->last),@endif
                @endforeach
            ],
            initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
            initialPreviewFileType: 'image' // image is the default and can be overridden in config below
        });
    </script>
@endsection