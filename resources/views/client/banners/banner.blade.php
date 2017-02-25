<section id="banner-holder" class="wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
    <div class="container">
        @foreach($banners->chunk(2) as $collection)
            <div class="row">
                @foreach($collection as $banner)
                    <div class="col-xs-12 col-lg-6 no-margin text-right banner right-banner">
                        <a href="/">
                            <div class="banner-text right">
                                <h1>Time &amp; Style</h1>
                                <span class="tagline">Checkout new arrivals</span>
                            </div>
                            <img class="banner-image img-responsive" alt="Banner" src="{{$banner->url}}">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div><!-- /.container -->
</section>