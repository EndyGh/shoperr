@extends("admin.common.layout")


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
                   @foreach($images as $image)
                       <div class="col-lg-4 col-md-4 col-xs-6 thumb" data-id="{{$image->id}}">
                           <a class="thumbnail" href="#"> <img class="img-responsive" src="{{asset($image->url)}}" alt="preview"> </a>
                           <a href="delete/{{$image->id}}" hidden="hidden" class="thumbnail-destroy">del</a>
                           <a href="#" class="destroy-image">Delete image <span style="text-decoration: underline">{{$image->url}}</span></a>
                       </div>
                   @endforeach
               </div>
                <div class="box-footer">{{$images->links()}}</div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('scripts')
    <script>
        $('.destroy-image').click(function(e){
            var that = $(this);
            e.preventDefault();
            swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this image!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(confirm){
                        swal('Success', "Record has been deleted.", "success");
                        if(confirm) {
                            setTimeout(function(){
                                console.log( that.prev('.thumbnail-destroy'));
                                that.prev('.thumbnail-destroy').get(0).click();
                            },700);
                        }
                    });
            return false;
        });
    </script>
@endsection