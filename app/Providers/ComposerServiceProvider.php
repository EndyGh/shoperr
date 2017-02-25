<?php

namespace App\Providers;

use App\Image;
use App\Product;
use App\Review;
use App\User;
use App\Category;
use App\Order;
use App\Page;
use App\Slider;
use Illuminate\Support\ServiceProvider;
use \View as View;
use \DB as DB;
use \Route as Route;
use Carbon\Carbon;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // slider on main
        View::creator('client.index', function($view) {
            $slider = Slider::where('active',true)->first();
            if(!$slider) $slider = new Slider();
            $view->with('slider',$slider);
        });


        // use categories tree in index page and catalog
        View::creator(['client.index','client.categories.traverse'], function($view) {
            $shop_categories_tree = Category::where('active',true)->get()->toTree();
            $view->with('shop_categories_tree', $shop_categories_tree);
        });

        // client header dropdown menu use it
        View::creator('client.common.header', function($view) {
            $shop_categories_all = Category::where('active',true)->get();
            $view->with('shop_categories_all', $shop_categories_all);
        });

        // client header pages menu use it
        View::creator('client.common.pages', function($view) {
            $shop_pages = Page::where('active',true)->get();
            $view->with('shop_pages', $shop_pages);
        });

        // random products if slider not included
        View::creator('client.products.random',function($view){
            $productsRandom = Product::inRandomOrder()->limit(4)->get();
            return $view->with('productsRandom',$productsRandom);
        });

        // banners
        View::creator('client.banners.banner',function($view){

            $uri = Route::current()->uri(); // current uri

            // get banners for current page
            $banners = Image::where('banner',true)
                ->where('for_page',$uri)
                ->get();

            // render it
            return $view->with('banners',$banners);
        });

        View::creator('admin.common.sidebar', function ($view) {
            $new_orders = Order::where('status', '!=', 'Завершен')
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->count();

            $new_reviews = Review::whereDate('created_at', Carbon::today()->toDateString())
                ->count();

            return $view->withNewOrders($new_orders)
                    ->withNewReviews($new_reviews);
        });


        // admin index page
        View::creator('admin.index', function($view) {


            $orders_this_month = Order::where( DB::raw('MONTH(created_at)'), '=', date('n') )->get();
            $ordersChart = \Charts::database($orders_this_month, 'bar', 'fusioncharts')
                ->title("Все Заказы за неделю")
                ->elementLabel("Всего")
                ->dimensions(550, 500)
                ->responsive(true)
                ->lastByDay(); // default 7

            $usersChart = \Charts::database(User::all(), 'bar', 'highcharts')
                ->title("Все Пользователи за неделю")
                ->elementLabel("Всего")
                ->dimensions(550, 500)
                ->responsive(true)
                ->lastByDay(); // default 7


            $products_count = Product::count();
            $users_count = User::count();
            $orders_count = Order::count();
            $categories_count = Category::count();

            /** @var \Illuminate\View\View */
            $view->with(compact(
                    'products_count','categories_count',
                    'orders_count','users_count','usersChart',
                    'ordersChart'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
