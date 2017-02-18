@if ($breadcrumbs)
    <ol class="breadcrumb-nav-holder">
        @foreach ($breadcrumbs as $breadcrumb)
            <?php $last = $breadcrumb->last; ?>
           @if($breadcrumb->first && $breadcrumb->title==config('breadcrumbs.index_title'))
               @if($last)
                  <li class="breadcrumb-item current gray"><i class="fa fa-home" aria-hidden="true"></i> {{ $breadcrumb->title }}</li>
               @else
                   <li class="breadcrumb-item" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{ $breadcrumb->url }}" itemprop="url"><span itemprop="title"><i class="fa fa-home" aria-hidden="true"></i> {{ $breadcrumb->title }}</span></a></li>
               @endif
            @elseif (!$last)
                <li class="breadcrumb-item" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{ $breadcrumb->url }}" itemprop="url"><span itemprop="title">{{ $breadcrumb->title }}</span></a></li>
            @else
                <li class="breadcrumb-item current gray">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
@endif