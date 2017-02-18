@extends("admin.common.layout")

@section("content")
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Brands</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                        $id = request()->segment(count(request()->segments()));
                        $isEditPage = !empty($id) && is_numeric($id);
                        $url = $isEditPage ? route('brand.post-update',compact('id')):route('brand.create');
                   ?>
                    <form action="<?php echo $url ?>" method="post">
                        {{ csrf_field() }}
                        <input type='text' name="name" value="{{$brand->name or ""}}" placeholder='Brand name' class='form-control input-sm' />
                        <br>
                        <input type="submit" id="sub" class="btn btn-success" value="Save">
                    </form>
                        <br>
                        @if($isEditPage)
                            <form action="{{route('brand.delete',['id'=>$brand->id])}}" method="post">
                                {{csrf_field()}}
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        @endif
                </div><!-- /.box-body -->
                <div class="box-footer"></div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection
