<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Price;
use Illuminate\Http\Request;
use JWTAuth;

class OrderController extends Controller
{
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
