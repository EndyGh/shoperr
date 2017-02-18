@extends("admin.common.layout")

@section('header_assets')
    <style>
        .preview-active a {
            border: 1px solid #1200ff !important;
        }
    </style>
@endsection

@section("content")
    <div class='row'>
        <div class='col-md-12'>
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
                    @if(count($brands))
                        <table id="entities" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td><a href="{{route('brand.update',['id'=>$brand->id])}}">{{$brand->id}}</a></td>
                                    <td>{{str_limit($brand->name,20)}}</td>
                                    <td>{{$brand->created_at}}</td>
                                    <td>{{$brand->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer">
                    {!! $brands->links() !!}
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('scripts')
    <script> $('#entities').DataTable({  paging: false});</script>
@endsection