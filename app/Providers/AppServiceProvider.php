<?php

namespace App\Providers;

use App\Product;
use App\Category;
use App\Services\HtmlBuilder;
use \DB as DB;
use \View as View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use \Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Category::saving(function ($model) {
            if ($model->isDirty('slug', 'parent_id')) {
                $model->generatePath();
            }
        });

        Category::saved(function ($model) {
            // Данная переменная нужна для того, чтобы потомки не начали вызывать
            // метод, т.к. для них путь также изменится
            $updating = false;

            if ( ! $updating && $model->isDirty('path')) {
                $updating = true;

                $model->updateDescendantsPaths();

                $updating = false;
            }
        });

        Product::deleting(function ($product) {
            DB::table('carts')->where('product_id',$product->id)->delete();
            return $product->id;
        });


        Collection::macro('withNumericKeys', function () {
            return $this->reduce(function ($assoc, $keyValuePair) {
                static $index = 0;
                $assoc[$index++] = $keyValuePair;
                return $assoc;
            }, new static);
        });

    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('HtmlEx',function() use (&$app) {
            return new HtmlBuilder($app['url'], $app['view']);
        });
    }
}
