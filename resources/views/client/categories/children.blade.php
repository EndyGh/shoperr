@foreach ($categories as $category)
    <li>
        <div class="accordion-heading" style="position: relative;">
            <a href="{{$category->getUrl()}}" style="position: absolute;left:-20px;top:3px;">
                <i class="fa fa-link" aria-hidden="true"></i>
            </a>
            <a href="#{{$category->name}}" data-link="{{$category->getUrl()}}" data-toggle="collapse">{{$category->name}}</a>
        </div>
        <div id="{{$category->name}}" class="accordion-body collapse in">
            @if( isset($category->children) && count($category->children ) > 0 )
                <ul>
                    @include('client.categories.children', array('categories' => $category->children))
                </ul>
            @endif
        </div>
        <!-- /.accordion-body -->
    </li>
@endforeach