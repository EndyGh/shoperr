@foreach($shop_categories_tree  as $category)
    <?php $hasChildren = (count($category->children) > 0); ?>
    <li class="dropdown menu-item">
        <a href="{{$category->getUrl()}}" @if($hasChildren)class="dropdown-toggle"
           data-toggle="dropdown"@endif>{{$category->name}}</a>
        @if($hasChildren)
            <ul class="dropdown-menu mega-menu">
                <li class="yamm-content">
                    @foreach($category->descendants()->get()->chunk(4) as $descendants_categories)
                        <div class="row">
                            @foreach($descendants_categories as $child)
                                <div class="col-md-4">
                                    <ul class="list-unstyled">
                                        <li style="border-bottom: 1px solid #e0e0e0;" class="sublist"><a href="{{$child->getUrl()}}">{{$child->name}}</a></li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                @endforeach
            </ul>
        @endif
    </li> <!-- /.menu-item -->
@endforeach