<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Category;
use App\Product;
use App\Brand;
use \DB as DB;

class CatalogController extends Controller
{

    public function show($path,Request $request)
    {
        $category = Category::where('path', '=', $path)->firstOrFail();
        $brands = Brand::all();
        $products = $category->products()->with('images')->paginate(9);
        $max_price = intval(Product::max('price_uah'));
        return view('client.catalog.catalog',compact('products','category','brands','max_price'));
    }

    /** Product Catalog Filter
     *
     * @param $category int Category id
     * @param Request $request
     */
    public function filter($category,Request $request)
    {
        $brands = $request->input('brands',null);
        $min_price = strval($request->input('price_from',1));
        $max_price = strval($request->input('price_to',1000));

        // Search products related to category with price range
        $products = Product::query()
            ->join('category_product', function ($join) use (&$category) {
                $join->on('products.id', '=', 'category_product.product_id')
                    ->where('category_product.category_id', '=', $category);
            })->whereBetween('price_uah', [$min_price, $max_price]);

        // Search products related to brand
        if ($request->has('brands')) {
            $brands = array_values($brands)[0];
            $products = $products->where('brand_id',$brands[0]);
        }

        return view('client.catalog.loop')->withProducts($products->get())->render();
    }
}
