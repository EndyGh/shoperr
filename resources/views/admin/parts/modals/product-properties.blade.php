<!-- Modal -->
<div id="property-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product details</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#panel1">Добавить свойства</a></li>
                    <li><a data-toggle="tab" href="#panel2">Редактировать свойства</a></li>
                </ul>

                <div class="tab-content">
                    <div id="panel1" class="tab-pane fade in active">
                        <h3>Свойства товара</h3>
                        <?php $url = route('property.store'); ?>
                        <form id="prop_form" action="<?php echo $url ?>" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" id="attached_props" name="attached">
                            <input type="hidden" id="del_product_prop" name="del_prop_id" value="">
                            <input type="hidden" name="product_id" value="{{$product->id or ""}}">
                            <input type='text' id="prop_name" name="name" value="{{$property->name or ""}}" placeholder='Property name' class='form-control input-sm' />
                            <br>
                            <input type='text' id="prop_value" name="value" value="{{$property->value or ""}}" placeholder='Property value' class='form-control input-sm' />
                            <br>
                            <input type="submit" id="sub-prop" class="btn btn-success" value="Save">
                        </form>
                    </div>
                    <div id="panel2" class="tab-pane fade">
                        <h3>Доступные свойства товара</h3>
                        <!-- Props -->
                        <div class="checkbox props">
                            @foreach($properties_not_attached as $property)
                                <div class="option-wrap">
                                    <label><input type="checkbox" data-id="{{$property['id']}}" name="{{$property['id']}}">{{$property['name']}}: {{$property['value']}}
                                        <a href="#"  class="options del_prop" data-id="{{$property['id']}}" data-name="{{$property['name']}}"><i class="fa fa-eye" aria-hidden="true" style="color: red !important;"></i></a></label>
                                </div>
                            @endforeach

                           @foreach($properties_attached as $property)
                                    <div class="option-wrap">
                                        <label><input type="checkbox" checked="checked" data-id="{{$property['id']}}" name="{{$property['id']}}">{{$property['name']}}: {{$property['value']}}
                                            <a href="#"  class="options del_prop" data-id="{{$property['id']}}" data-name="{{$property['name']}}"><i class="fa fa-eye" aria-hidden="true" style="color: red !important;"></i></a></label>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Content here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>