@foreach ($shop_categories_tree as $category)
    <?php $children = ( isset( $category->children ) && count($category->children ) > 0 ) ?>
    <div class="accordion-group">
        <div class="accordion-heading" style="position: relative;">
            <a href="{{$category->getUrl()}}" style="position: absolute;left:-20px;top:3px;">
                <i class="fa fa-link" aria-hidden="true"></i>
            </a>
                  <a class="accordion-toggle @if(!$children){{'root-only'}}@endif" data-link="{{$category->getUrl()}}" data-toggle="collapse" href="#{{ $category->name }}" data-parent="#accordion">
                      {{ $category->name }}
                  </a>
        </div>
        @if( isset( $category->children ) && count($category->children ) > 0 )
            <div id="{{ $category->name }}" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <ul>
                        @include('client.categories.children', array('categories' => $category->children))
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endforeach




