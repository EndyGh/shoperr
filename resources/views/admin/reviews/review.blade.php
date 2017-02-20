@extends('admin.common.layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Отзывы о товаре</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <td class="box-body">
                    @if(count($reviews))
                        @include('admin.reviews.edit-modal')
                        <table id="entities" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Товар</th>
                                <th>Пользователь</th>
                                <th>Роль пользователя</th>
                                <th>Рейтинг</th>
                                <th>Отзыв</th>
                                <th>Статус</th>
                                <th>Спам</th>
                                <th>Создан</th>
                                <th>Обновлен</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>
                                      {{$review->id}}
                                    </td>
                                    <td>{{$review->product->name}}</td>
                                    <td>{{$review->user->name}}</td>
                                    <td>{{$review->user->role}}</td>
                                    <td>{{$review->rating}}</td>
                                    <td>{{$review->shortComment}}</td>
                                    <td>{{$review->approved}}</td>
                                    <td>{{$review->spam}}</td>
                                    <td>{{$review->created_at}}</td>
                                    <td>{{$review->updated_at}}</td>
                                    <td>
                                        <i data-toggle="modal" data-target="#edit-modal"
                                           data-route="{{route('reviews.edit',$review->id)}}"
                                           class="fa fa-pencil-square-o btn bg-orange edit-button"
                                           aria-hidden="true" style="float: left; margin-right: 5px;">
                                        </i>
                                        {!! Form::open(['route' => ['reviews.destroy',$review->id], 'method'=>'DELETE']) !!}
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
                    {!! $reviews->links() !!}
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
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