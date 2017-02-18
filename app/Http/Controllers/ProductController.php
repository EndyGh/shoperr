<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Review;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index');
    }


    /**
     * Display single record.
     *
     * @param  $name string
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $product = Product::with
        (['images', 'properties.products', 'categories', 'brands', 'tagged'])
            ->where('name', '=', $name)
            ->first();

        $reviews = $product->reviews()
            ->with('user')
            #->approved()
          #  ->notSpam()
            ->orderBy('created_at','desc')
            ->get();


        return view('client.products.single',compact('product','reviews'));
    }

    public function recentlyViewed(Request $request)
    {
        $products = $request->input('products', []);
        if ($request->ajax()) {

            $products_ids =  collect(json_decode($products))->map(function($id){return intval($id);});
            if(count($products))
                 $products = Product::whereIn('id', $products_ids)->limit(10)->get();

            return view('client.products.recently-viewed', compact('products'))->render();
        } elseif( !count($products) ){
            return '';
        } else {
            return redirect()->back();
        }
    }

    public function storeReviewForProduct(Request $request,$id)
    {

        $this->validate($request, [
            'comment' => 'required|max:1555',
        ]);

        $product = Product::findOrFail($id);
        $review = new Review();

        $review->user_id = $request->user()->id;
        $review->comment = $request->input('comment');
        $review->rating = intval($request->input('rating'));
        $product->reviews()->save($review);

        // recalculate ratings for the specified product
        $product->recalculateRating();

        return redirect()->back();
    }

}
