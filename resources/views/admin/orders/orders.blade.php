@extends('admin.common.layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Заказы</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <td class="box-body">
                    @if(count($orders))
                        @include('admin.orders.edit-modal')
                        <table id="entities" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Всего</th>
                                <th>Пользователь</th>
                                <th>Роль пользователя</th>
                                <th>Статус</th>
                                <th>Создан</th>
                                <th>Обновлен</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->total}} UAH</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->user->role}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->updated_at}}</td>
                                    <td>
                                        <i data-toggle="modal" data-target="#edit-modal"
                                           data-route="{{route('orders.edit',$order->id)}}"
                                           class="fa fa-pencil-square-o btn bg-orange edit-button"
                                           aria-hidden="true" style="float: left; margin-right: 5px;">
                                        </i>
                                        {!! Form::open(['route' => ['orders.destroy',$order->id], 'method'=>'DELETE']) !!}
                                        <button type="submit"
                                                class="fa fa-trash-o btn bg-red delete-button"
                                                aria-hidden="true"></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                @endif
            </div><!-- /.box-body -->
            <div class="box-footer">
                {!! $orders->links() !!}
            </div>
        </div><!-- /.box -->
    </div><!-- /.row -->
@endsection


@section('scripts')
    <script>
        $('#entities').DataTable({paging: false});

        $('.edit-button').click(function(){

            $('#edit-modal .modal-body').load($(this).data('route'));

        });
    </script>
@endsection