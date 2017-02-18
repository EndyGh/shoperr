@extends('client.common.layout')

@section('content')
    <div class="container" style="padding-top:35px;">
        <div class="row">
            {!! Breadcrumbs::render('page',$page) !!}
            <div class="col-xs-12">
                {!! $page->description !!}
            </div>
        </div>
    </div>
@endsection