@extends("admin.common.layout")

@section('header_assets')
    <style>

        .thumbnail {
            outline: none !important;
        }
        .preview-active a {
            border: 1px solid #0fad64 !important;
        }

        .fa-check {
            display: none;
        }

        .preview-active .fa-check {
            display: block;
            color: #0fad64;
        }

        .question-circle {
           position: relative;
           margin-bottom: 15px;
        }

        .question-circle .fa-question-circle {
            position: absolute;
            top: 7px;
            left: -17px;
        }

        .options {
            margin-left: 5px;
        }
    </style>
@endsection

@section("content")
    <div class='row'>
        <div class='col-md-8'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Products</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                        $id = request()->segment(count(request()->segments()));
                        $isEditPage = !empty($id) && is_numeric($id);
                        $url = $isEditPage ? route('product.post-update',compact('id')):route('product.create')
                    ?>
                    <form action='<?php echo $url ?>' method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <i class="fa fa-eye" aria-hidden="true"></i> Product visibility
                        <?php $visible = isset($product->active) && $product->active == 1 ?>
                        <input type="checkbox" style="margin:3px 0 0 7px;" <?php if($visible) echo 'checked'; ?> name="active"> <br><br>
                        <!-- Attached models to product -->


                        <input type="text" hidden  value="{{$product->images or "{}"}}" id="product_images_related">
                        <input type="text" hidden  value="{{$product->categories or "{}"}}" id="product_categories_related">
                        <input type="text" hidden  value="{{"{}"}}" id="product_brands_related">
                        <input type="text" hidden id="tags" name="tags">

                        <input type='text' id="product-title" name="title" value="{{$product->title or ""}}" placeholder='Product title' class='form-control input-sm' />
                        <br>
                        <input type='text' id="product-name" name="product_name" value="{{$product->name or ""}}" placeholder='Product name' class='form-control input-sm' />
                        <br>
                        <input type='number' id="product-price" step="any" name="price_usd" value="{{$product->price_usd or ""}}" placeholder='Product price' class='form-control input-sm' />
                        <br>
                        <input type='number' id="product-amount" name="amount" value="{{$product->amount or ""}}" placeholder='Product amount' class='form-control input-sm' />
                        <br>
                        <input type='text' id="product-code" name="code" value="{{$product->code or ""}}" placeholder='Product code' class='form-control input-sm' />
                        <br>
                        <input type="text" name="guarantee" value="{{$product->guarantee or 'Без гарантии' }}" placeholder="Гарантия" class="form-control input-sm">
                        <br>
                        <textarea name="description" id="tinymce"></textarea>
                        <input type="text" name="categories" id="categories_input" hidden="hidden">
                        <input type="text" name="images" id="images_input" hidden="hidden">
                        <input type="text" name="brands" id="brands_input" hidden="hidden">
                        <input type="submit" id="sub" hidden="hidden">
                       @include('admin.parts.modals.product-cats')
                       @include('admin.parts.modals.product-brands')
                     @if($isEditPage)
                        @include('admin.parts.modals.product-properties')
                       @endif
                </div><!-- /.box-body -->
                <div class="box-footer"></div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Settings</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                   Product categories <br>
                    <a href="#" class="select-all-checkbox" data-target=".cats" style="text-decoration: underline;">Select all</a>
                    <div class="checkbox cats">
                        @foreach($categories as $category)
                            <div class="option-wrap">
                                <label><input type="checkbox" data-id="{{$category->id}}" name="{{$category->id}}">{{$category->name}}
                                    <a href="#" class="options" data-id="{{$category->id}}" data-name="{{$category->name}}" data-slug="{{$category->slug}}" data-active="{{$category->active}}"><i class="fa fa-eye" aria-hidden="true"></i></a></label>
                                <a href="{{ route('category.delete',['id'=>$category->id]) }}" class="options_delete" style="margin-left: 5px;color: red;"><i class="fa fa-eye" aria-hidden="true"></i></a> <br>
                            </div>
                        @endforeach
                    </div>
                    @if($isEditPage) Price in UAH {{$product->price_uah or ""}} &#8372; @endif
                    <a href="#" id="currency_btn" style="text-decoration: underline;display: block;margin-bottom: 8px;">Update currency.xml</a>
                    @if($isEditPage) <a href="#" id="property_btn" style="text-decoration: underline;display: block;margin-bottom: 8px;">Product details</a> @endif

                    @if($isEditPage)
                        <form action="{{route('product.delete',['id'=>$product->id])}}" method="post">
                            {{csrf_field()}}
                            <button type="button" class="btn btn-success" id="save_btn">Update</button>
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    @else
                        <button type="button" class="btn btn-success" id="save_btn">Save</button>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer"></div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div> <!-- / .col -->

        <div class="col-md-4">
            <!-- Box -->
            <div class="box box-primary" style="overflow-y: scroll;max-width:400px;max-height:175px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Tags</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <a href="#" style="text-decoration: underline;" id="delete_all_tags">Clear all tags</a>
                    <input style="max-width:300px;" type="text" name="all_tags" id="all_tags">
                </div><!-- /.box-body -->
                <div class="box-footer">

                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div> <!-- / .col -->

        <div class="col-md-4">
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
                    Product brands <br>
                    <a href="#" class="select-all-checkbox" data-target=".brands" style="text-decoration: underline;">Select all</a>
                    <div class="checkbox brands">
                        @foreach($brands as $brand)
                           <div class="option-wrap">
                               <label><input type="checkbox" data-id="{{$brand->id}}" @if(!is_null($product->brands) && $product->brands->id == $brand->id)checked="checked"@endif name="{{$brand->id}}">{{$brand->name}}</label>
                               <a href="#" data-id="{{$brand->id}}" data-name="{{$brand->name}}" class="options"><i class="fa fa-eye" aria-hidden="true"></i></a>
                               <a href="{{ route('brand.delete',['id'=>$brand->id]) }}" class="options_delete" style="margin-left: 5px;color: red;"><i class="fa fa-eye" aria-hidden="true"></i></a> <br>
                           </div>
                        @endforeach
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer"></div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div> <!-- / .col -->

        <div class="col-xs-12 col-md-4" style="float:right;">
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Preview</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @foreach($images as $image)
                        <div class="col-lg-4 col-md-4 col-xs-6 thumb" data-id="{{$image->id}}">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <a class="thumbnail" href="#"> <img class="img-responsive" src="{{asset($image->url)}}" alt="preview"> </a>
                        </div>
                    @endforeach
                </div><!-- /.box-body -->
                <div class="box-footer">

                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div> <!-- / .col -->

    </div><!-- /.row -->
@endsection

@section("scripts")
    <?php $item = $product or collect([]); ?>
    @include('admin.parts.tinymce',compact('item'))

    <script>
        var tags = [
                @foreach ($tags->toArray() as $tag)
            {tag: "{{$tag}}" },
            @endforeach
        ];

        @if($isEditPage)
         <?php $related_tags = $related_tags or []; ?>
         $('#all_tags').val('{{implode(',', $related_tags)}}');
         $('#tags').val('{{implode(',',$related_tags)}}');
        @endif


     $('#all_tags').change(function(){
            $('#tags').val($(this).val());
        });

        var $select = $('#all_tags').selectize({
            plugins:['remove_button'],
            delimiter: ',',
            persist: false,
            valueField: 'tag',
            labelField: 'tag',
            searchField: 'tag',
            options: tags,
            create: function(input) {
                return {
                    tag: input
                }
            }
        });
        var control = $select[0].selectize;

        $('#delete_all_tags').click(function(e){
            e.preventDefault();
            control.clear();
            return false;
        });

    </script>
    <script>
        var relatedImages = JSON.parse($('#product_images_related').val());
        console.log(relatedImages);
        var relatedCategories = JSON.parse($('#product_categories_related').val());

        $('.thumb').each(function(){
            var id = $(this).data('id');
            var that = $(this);
            if(!relatedImages.length) return;
            relatedImages.forEach(function(e){
                if(id == e.id) that.addClass('preview-active');
            });
        });

        $('.checkbox.cats input').each(function(){
            var id = $(this).data('id');
            var that = $(this);
            if(!relatedCategories.length) return;
            relatedCategories.forEach(function(e){
                if(id == e.id) that.attr("checked", "checked");
            });
        });

        $('.del_prop').click(function(e){
            e.preventDefault();
           var id = $(this).data('id');
            swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this record!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        swal({
                            title: "Message",
                            text: 'Click save to delete this prop!',
                            timer: 1000,
                            showConfirmButton: false
                        });
                        $('#del_product_prop').val(id);
                    });
            return false;
        });


        $('button#save_btn').on('click',function(){
            $('#sub').click();
        });

        $( ".thumb" ).on( "click", function() {
            $('.fa-check',this).toggle();
            $( this ).toggleClass('preview-active');
        });

        $('#prop_form').submit(function(e){
            var attached = [];
            $('input:checked','.checkbox.props').each(function() {
                attached.push($(this).data('id'));
            });

            $('#attached_props').val(attached);
        });

        $('form').on('submit',function(e){
            var catObj = {};
            var imgObj = {};
            var brandObj = {};

            $('.checkbox.cats input').each(function(){
                var boxName = $(this).attr('name');
                var boxValue = +$(this).is(':checked');
                catObj[boxName] = boxValue;
            });

            $('.checkbox.brands input').each(function(){
                var boxName = $(this).attr('name');
                var boxValue = +$(this).is(':checked');
                brandObj[boxName] = boxValue;
            });

            $('.preview-active').each(function(){
                imgObj[$(this).data('id')] = 1;
            });

            $('#categories_input').val(JSON.stringify(catObj));
            $('#images_input').val(JSON.stringify(imgObj));
            $('#brands_input').val(JSON.stringify(brandObj));
        });

    </script>
    <script type="text/javascript">

        var currencyRoute = '{{ route("product.update.currency") }}';
        var option = {
            cat:{},
            brand:{}
        };

        Tipped.create('#product-title','Product title DISPLAY NAME');
        Tipped.create('#product-name','Product name URL');
        Tipped.create('#product-amount','Product amount');
        Tipped.create('#product-price','Product price in USD');
        Tipped.create('#product-code','Product code');

        $('.select-all-checkbox').click(function(e){
            e.preventDefault();
            $(':checkbox',$(this).data('target')).click();
        });

        $("input[type='checkbox']",'.brands').change(function(){
            $(':checked','.brands').not(this).prop( "checked", false );
        });

        // modals begin

        $('.options','.cats').click(function(e){
            e.preventDefault();
            $('#category-modal').modal();
            option.cat.name = $(this).data('name');
            option.cat.slug = $(this).data('slug');
            option.cat.active = $(this).data('active');
            option.cat.id = $(this).data('id')
        });

        $('.options','.brands').click(function(e){
            e.preventDefault();
            $('#brand-modal').modal();
            option.brand.name = $(this).data('name');
            option.brand.id = $(this).data('id')
        });

        $('#category-modal').on('shown.bs.modal', function() {
            var form = $('form','#brand-modal');
            var url = form.attr('action').replace(/\d/,option.id);
            form.attr('action',url);
            $('#name','#category-modal').val(option.cat.name);
            $('#slug','#category-modal').val(option.cat.slug);
            if(+option.cat.active) {
                $('#active', '#category-modal').click();
            }
        });

        $('#brand-modal').on('shown.bs.modal', function() {
            var form = $('form','#brand-modal');
            var url = form.attr('action').replace(/\d/,option.brand.id);
            form.attr('action',url);
            $('#name','#brand-modal').val(option.brand.name);
        });

        // modals end

        $('#currency_btn').click(function(e){
            e.preventDefault();
            $.get( currencyRoute, function( data ) {
              var message = data.message;
                swal({
                    title: "Message",
                    text: message,
                    timer: 1000,
                    showConfirmButton: false
                });
            });
        });

        $('#property_btn').click(function(e){
            e.preventDefault();
            $('#property-modal').modal();
           // option.brand.name = $(this).data('name');
            // option.brand.id = $(this).data('id')
        });


        $('.options_delete').click(function(e){
            e.preventDefault();
            var that = $(this);
            var url = that.attr('href');
            swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this record!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        $.ajax({
                            url:url,
                            method:'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(data){
                                that.parent('.option-wrap').remove();
                                swal(data, "Record has been deleted.", "success");
                            }
                        });
                    });
            return false;
        });
    </script>
@endsection

@yield('product_scripts')
