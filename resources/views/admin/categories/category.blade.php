@extends("admin.common.layout")

@section("content")
    <div class='row'>
        <div class='col-md-8'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Categories</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                        $id = request()->segment(count(request()->segments()));
                        $isEditPage = !empty($id) && is_numeric($id);
                        $url = $isEditPage ? route('category.post-update',compact('id')):route('category.create');
                    ?>
                     @include('admin.parts.edit-categories-form',compact('url','category'))
                      <br>
                        @if($isEditPage)
                            <form action="{{route('category.delete',['id'=>$category->id])}}" method="post">
                                {{csrf_field()}}
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        @endif
                </div><!-- /.box-body -->
                <div class="box-footer"></div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-4">
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Parent category</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <select class="selectpicker form-control" data-live-search="true" title="No parent...">
                        @foreach($categories as $category)
                            @if($loop->iteration==1)<option data-hidden="true"></option> @endif
                            <option data-id="{{(int)$category->id}}"
                            <?php if($category->id == $id) echo 'disabled'?>>
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>

                  <div style="display: none;">
                      @foreach($categories as $category)
                          <div class="radio @if($category->id == $id){{'disabled'}}@endif">
                              {{$category->name}}
                              <label><input type="radio"
                                            @if($category->id == $id){{'data-target-id='}}{{$category->parent_id or 0}}
                                            data-descendants="<?php echo implode(",",$category->descendants()->pluck('id')->toArray())?>"
                                            @endif
                                            data-id="{{(int)$category->id}}"
                                            data-name="{{$category->name}}"
                                            @if($category->id == $id){{'disabled'}}@endif
                                            name="parent-category"
                                            value="{{$category->id}}"> {{$category->path}}</label> <br>
                          </div>
                      @endforeach
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer"></div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div> <!-- / .col -->

    </div><!-- /.row -->
@endsection

@section("scripts")
    <script>
        var parent = void 0;
        var currentCatId = '{{$id}}' || null;

        var desc = $("input[data-id="+currentCatId+"]:radio").data('descendants')+"";
        desc = desc.split(/,/);



        $('.selectpicker').on('changed.bs.select', function () {

            var selected = $.map($(this).find("option:selected"), function(o) { return $(o).data('id') });
            $("input[data-id="+selected+"]:radio").click();
        });

        $("input[name=parent-category]:radio").change(function(e){
           $('#parent-cat').val( $(this).val() );
        });

        $("input[name=parent-category]:radio").each(function(i,e){
         var target = $(e);
         var targetId = target.data('target-id');
            var id = $(e).data('id')+'';
            var name = '';
            if(desc.indexOf( id ) !== -1) {
                var id = $(this).data('id');
                $(this).parents('.radio').addClass('disabled');
                $('option[data-id='+id+']','.selectpicker').attr('disabled','disabled');
                $(this).attr('disabled','disabled');
            }
            if(targetId != undefined && targetId != 0) {
                parent = +targetId;
                var radioElement = $("input[data-id="+parent+"]:radio");
                name = radioElement.data('name');
                radioElement.click();
                select(name);
            }
        });


        function select(name){
            name = name || '';
            $('.selectpicker').val(name);
        }

    </script>
@endsection