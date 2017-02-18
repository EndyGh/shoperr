@extends("admin.common.layout")

@section("content")
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pages</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                        $id = request()->segment(count(request()->segments()));
                        $isEditPage = !empty($id) && is_numeric($id);
                        $url = $isEditPage ? route('page.post-update',compact('id')):route('page.create');
                    ?>
                    <form action="<?php echo $url ?>" method="post">
                        {{ csrf_field() }}
                        <i class="fa fa-eye" aria-hidden="true"></i> Page visibility
                        <?php $visible = isset($page->active) && $page->active == 1 ?>
                        <input type="checkbox" style="margin:3px 0 0 7px;" <?php if($visible) echo 'checked'; ?> name="active"> <br><br>
                        <input type='text' name="path" value="{{$page->path or ""}}" placeholder='Page path' class='form-control input-sm' />
                        <br>
                        <input type='text' name="slug" value="{{$page->slug or ""}}" placeholder='Page slug' class='form-control input-sm' />
                        <br>
                        <textarea name="description" id="tinymce"></textarea> <br>
                        <input type="submit" id="sub" class="btn btn-success" value="Save">
                    </form>
                    <br>
                    @if($isEditPage)
                      <form action="{{route('page.delete',['id'=>$page->id])}}" method="post">
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

@section("scripts")
    <?php $item = $page or collect([]); ?>
    @include('admin.parts.tinymce',compact('item'))
@endsection
