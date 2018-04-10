<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Order;
use App\OrderItem;
use App\Price;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use JWTAuth;

class OrderController extends BaseController
{
    public function postOrder(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $carts = CartItem::where('user_id', $user->user_id)->get();

        $order = Order::create([
            'user_id' => $user->user_id,
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity
            ]);

            $cart->delete();
        }

        return response()->json(['data' => $order, 'status' => 'ok']);
    }

    public function getBuyerOrders(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $orders = Order::orderBy('order_id', 'desc')->get();

        $orderArray = [];

        foreach ($orders as $order) {
            $prices = Price::where('product_id', $order->product_id)->orderBy('created_at', 'desc')->first();

            $neworder["order_id"] = $order->order_id;
            $neworder["user_id"] = $order->user_id;
            $neworder["product_id"] = $order->product_id;
            $neworder["item_quantity"] = $order->item_quantity;

            $neworder["product_price"] = $prices->product_price;
            // $neworder["product_price"] = $prices->promo_price;

            $neworder["created_at"] = $order->created_at;

            array_push($orderArray, $neworder);
        }

        return response()->json(['data' => $orderArray, 'status' => 'ok']);
    }
}
