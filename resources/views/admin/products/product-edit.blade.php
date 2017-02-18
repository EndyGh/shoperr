@extends("admin.common.layout")

@section("content")
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Products</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                    <div class="box-body">
                        @if(count($products))
                        <table id="entities" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><a href="{{route('product.update',['id'=>$product->id])}}">{{$product->id}}</a></td>
                                    <td>{{str_limit($product->name,10)}}</td>
                                    <td>{{str_limit($product->title,10)}}</td>
                                    <td>{{$product->price_usd}}</td>
                                    <td>{{$product->amount}}</td>
                                    <td>{{str_limit($product->code,15)}}</td>
                                    <td>{{str_limit($product->description,10)}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>{{$product->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                      @endif
                </div><!-- /.box-body -->
            <div class="box-footer">
                {!! $products->links() !!}
            </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('scripts')
    <script> $('#entities').DataTable({  paging: false});</script>
@endsection