<!-- Modal -->
<div id="brand-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Quick update</h4>
            </div>
            <div class="modal-body">
                <!-- Content here -->
                <?php $url = route('brand.post-update',['id'=>1]); ?>
                <form action="<?php echo $url ?>" method="post">
                    {{ csrf_field() }}
                    <input type='text' id="name" name="name" value="{{$brand->name or ""}}" placeholder='Brand name' class='form-control input-sm' />
                    <br>
                    <input type="submit" id="sub" class="btn btn-success" value="Save">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>