<form action="<?php echo $url ?>" method="post">
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
    <input type="submit" id="sub" class="btn btn-success" value="Save">
</form>