{!! Form::open(['route' => ['orders.update',$order->id], 'method'=>'PUT']) !!}

    <div class="form-group">
        {!! Form::label('status','Статус заказа',['class' => 'control-label']) !!} <br>
        {!!Form::select('status',
            ['Завершен'=>'Завершен','В обработке'=>'В обработке'],
             $order->status,
            ['class'=>'form-control'])
        !!}
    </div>

    <div class="box box-solid box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Содержимое заказа</h3>
            <div class="box-tools pull-right">
                <span class="label label-primary">Товары</span>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>x</th>
                    <th>Товар</th>
                    <th>Код товара</th>
                    <th>Цена товара</th>
                </tr>
                </thead>
                <tfoot>
                <tr></tr>
                </tfoot>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{$item->quantity or 1}}</td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->product->code}}</td>
                        <td>{{$item->product->price_uah}} грн</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box products -->

    <div class="box box-solid box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Контакты покупателя</h3>
        <div class="box-tools pull-right">
            <span class="label label-primary">контакты</span>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Email</th>
                <th>Город</th>
                <th>Телефон</th>
                <th>Адрес доставки</th>
            </tr>
            </thead>
            <tfoot>
            <tr></tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>{{$order->details->first_name}}</td>
                    <td>{{$order->details->last_name}}</td>
                    <td>{{$order->details->email}}</td>
                    <td>{{$order->details->city}}</td>
                    <td>{{$order->details->phone}}</td>
                    <td>{{$order->details->shipping_address}}</td>
                </tr>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box  user detail -->



{!! Form::submit('Редактировать',['class'=>'btn btn-success']) !!}

{!! Form::close() !!}