<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\OrderDetail as Detail;
use Illuminate\Http\Request;
use \Cart as Cart;
use \NumberFormatter;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('client.checkout.checkout');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'city' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/[0-9]{3}\s[0-9]{2}\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}/',
            'shipping_address' => 'required',
        ]);


        $user = $request->user()->id;
        $cart = Cart::content();
        $total = floatval(preg_replace('/[^\d.]/', '', Cart::instance('default')->total() ));

        #$total = 0;
        #foreach($cart as $item) {$total += floatval($item->subtotal);}


        $order = new Order();
        $order->total =  $total;// Cart::instance('default')->subtotal(); // without tax
        $order->user_id = $user;
        $order->save();

        $detail = new Detail();
        $detail->fill($request->all());
        $order->details()->save($detail);

        foreach($cart as $item){
            $orderItem = new OrderItem();
            $orderItem->order_id=$order->id;
            $orderItem->quantity = $item->qty;
            $orderItem->product_id=intval($item->id);
            $orderItem->save();
        }

        Cart::destroy();

        return redirect('/')->with('order-message', 'Order success!');

    }
}
