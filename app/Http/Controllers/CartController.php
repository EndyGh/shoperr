<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Collection;
use App\Product;
use App\Cart as CartModel;
use \Cart as Cart;
use \Validator;
use \Auth as Auth;
use \DB as DB;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // checks that product exists
        // if product was deleted from DB
        // we must delete him from Cart
        // because cart uses model association and if product
        // not exists it will create exception trying to get property of non-object

        if (sizeof(Cart::content()) > 0) {

            $user = auth()->user();

            $cartModelContent = CartModel::where('user_id', $user->id)
                ->get(['carts.row_id AS rowId', 'carts.product_id AS id'])
                ->pluck('rowId')->toArray();


            $cartContent = Cart::content()->pluck('rowId')->toArray();

            // cart items id
            if (!sizeof($cartModelContent)) {
                $removeContent = $cartContent; // all rowIds
            } else {
                $removeContent = array_diff($cartContent,$cartModelContent);
            }

            foreach ($removeContent as $id) {
                Cart::remove($id);
            }

        }


        return view('client.catalog.cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        $hasDuplicates = !$duplicates->isEmpty(); // if not empty means that item in cart

        if ($hasDuplicates) {
            return redirect('cart')->withSuccessMessage('Такой товар уже есть!');
        }

        $product = Product::findOrFail($request->id);

        $images = $product->images;

        if (!$images->count()) {
            $images = asset('img/no_preview.jpg');
        } else {
            $images = $images->first()->url;
        }

        $options = [
            'name' => $product->name,
            'slug' => $product->slug,
            'image' => $images,
            'guarantee' => $product->guarantee,
            'price_usd' => $product->price_usd,
            'price_uah' => $product->price_uah,
        ];

        $cart = Cart::add($request->id, $request->name, $request->get('quantity', 1), floatval($request->price),$options)->associate(Product::class);

        $cartModel = new CartModel();
        $cartModel->user_id = $user->id;
        $cartModel->row_id = $cart->rowId;
        $cartModel->product_id = $request->id;
        $cartModel->save();

        return redirect('cart')->withSuccessMessage('Товар добавлен в корзину!');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
      $product_id = Cart::get($id)->id;
      $product = Product::findOrFail($product_id);

        // Validation on max quantity
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,'.$product->amount
        ]);
        if ($validator->fails()) {
            session()->flash('error_message', 'Всего доступно '.$product->amount);
            return response()->json(['success' => false]);
        }
        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Количество обновлено!');
        return response()->json(['success' => true]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartModel::where('row_id',$id)->where('user_id',Auth::user()->id)->delete();
        Cart::remove($id);
        return redirect('cart')->withSuccessMessage('Товар удален из корзины!');
    }
    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        DB::table('carts')->where('user_id',Auth::user()->id)->delete();
        Cart::destroy();
        return redirect('cart')->withSuccessMessage('Корзина очищена!');
    }

    /**
     * Switch item from shopping cart to wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToWishlist($id)
    {
        $item = Cart::get($id);
        Cart::remove($id);
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Товар уже есть в списке желаний!');
        }
        Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');
        return redirect('cart')->withSuccessMessage('Товар был перемещен в список желаний!');
    }
}
