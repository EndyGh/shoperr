<!-- Modal -->
<div id="category-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Quick update</h4>
            </div>
            <div class="modal-body">
                <!-- Content here -->
                <?php $url = route('category.post-update',['id'=>1]); ?>
                <form id="category-form" action="<?php echo $url ?>" method="post">
                    {{ csrf_field() }}
                    <br>
                    <label for="name">Name</label>
                    <input type='text' name="name" id="name" value="{{$category->name or ""}}" placeholder='Category name' class='form-control input-sm' />
                    <br>
                    <label for="slug">Slug</label>
                    <input type='text' name="slug" id="slug" value="{{$category->slug or ""}}" placeholder='Category slug' class='form-control input-sm' />
                    <br>
                    Видимость категории
                    <?php $visible = isset($category->active) && $category->active == 1 ?>
                    <input type="checkbox" @if($visible) checked="checked" @endif name="active" id="active">
                    <br><br>
                    <input type="hidden" name="parent-category" value="0" id="parent-cat">
                    <input type="submit" id="submit_cat" class="btn btn-success" value="Update">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>