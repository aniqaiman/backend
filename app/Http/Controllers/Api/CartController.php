<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Http\Controllers\Controller;
use App\Price;
use App\Product;
use Illuminate\Http\Request;
use JWTAuth;

class CartController extends Controller
{
    public function getCartItems(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $carts = CartItem::where('user_id', $user->user_id)->get();

        foreach ($carts as $cart) {
            $cart["product"] = Product::where('product_id', $cart['product_id'])->first();

            $prices = Price::where('product_id', $cart->product_id)->orderBy('created_at', 'desc')->take(2)->get();
            $cart->product["priceA"] = $prices[0]->product_price;
            $cart->product["priceB"] = $prices[0]->product_price2;
            $cart->product["priceC"] = $prices[0]->product_price3;
            $cart->product["priceADiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price - $prices[1]->product_price) / $prices[1]->product_price, 2) : 0;
            $cart->product["priceBDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price2 - $prices[1]->product_price2) / $prices[1]->product_price2, 2) : 0;
            $cart->product["priceCDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price3 - $prices[1]->product_price3) / $prices[1]->product_price3, 2) : 0;
        }

        return response()->json(['data' => $carts, 'status' => 'ok']);
    }

    public function getTotalCartItems(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $count = CartItem::where('user_id', $user->user_id)->count();
        return response()->json(['data' => $count, 'status' => 'ok']);
    }

    public function getTotalPrice(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $carts = CartItem::where('user_id', $user->user_id)->get();
        $total = 0;

        foreach ($carts as $cart) {
            $cart["product"] = Product::where('product_id', $cart['product_id'])->first();
            $price = Price::where('product_id', $cart['product_id'])->orderBy('created_at', 'desc')->first();
            $total += ($price->product_price * $cart->quantity);
        }

        return response()->json(['data' => $total, 'status' => 'ok']);
    }

    public function postCartItem(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $item = CartItem::where([
            ['user_id', '=', $user->user_id],
            ['product_id', '=', $request->get('product')['id']],
        ]);

        if ($item->exists()) {
            $item = $item->first();
            $item->quantity = $request->get('quantity');
            $item->save();
        } else {
            $item = CartItem::create([
                'user_id' => $user->user_id,
                'product_id' => $request->get('product')['id'],
                'quantity' => $request->get('quantity'),
            ]);
        }

        return response()->json(['data' => $item, 'status' => 'ok']);
    }

    public function deleteCartItem($product_id, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $item = CartItem::where([
            ['user_id', '=', $user->user_id],
            ['product_id', '=', $product_id],
        ])->first()->delete();

        return response()->json(['status' => 'ok']);
    }
}
