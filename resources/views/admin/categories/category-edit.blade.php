@extends("admin.common.layout")


@section("content")
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Categories</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                @if(count($categories))
                    <table id="entities" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>path</th>
                            <th>Date created</th>
                            <th>Date updated</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>path</th>
                            <th>Date created</th>
                            <th>Date updated</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td><a href="{{route('category.update',['id'=>$category->id])}}">{{$category->id}}</a></td>
                                <td>{{str_limit($category->name,15)}}</td>
                                <td>{{str_limit($category->slug,20)}}</td>
                                <td>{{str_limit($category->getUrl(),50)}}</td>
                                <td>{{$category->created_at}}</td>
                                <td>{{$category->updated_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="box-footer"> {!! $categories->links() !!}</div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div>
@endsection

@section('scripts')
    <script>$('#entities').DataTable({  paging: false});</script>
@endsection