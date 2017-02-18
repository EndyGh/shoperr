<ul class="nav navbar-nav">
    <li><a href="{{route('index')}}">Главная</a></li>
    @foreach($shop_pages as $page)
        <li><a href="{{route('pages.show',$page->path)}}">{{$page->slug}}</a></li>
    @endforeach
</ul>