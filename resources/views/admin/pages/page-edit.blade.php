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
                    <h3 class="box-title">Pages</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if(count($pages))
                        <table id="entities" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Path</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Path</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td><a href="{{route('page.update',['id'=>$page->id])}}">{{$page->id}}</a></td>
                                    <td>{{str_limit($page->path,50)}}</td>
                                    <td>{{str_limit($page->slug,50)}}</td>
                                    <td>{{str_limit($page->description,50)}}</td>
                                    <td>{{$page->created_at}}</td>
                                    <td>{{$page->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer">
                    {!! $pages->links() !!}
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('scripts')
    <script> $('#entities').DataTable({  paging: false});</script>
@endsection