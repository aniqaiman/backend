<?php

namespace App\Http\Controllers\Api;

use App\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function getCartItems($user_id, Request $request)
    {
        $carts = CartItem::where('user_id', $user_id)->get();

        foreach ($carts as $cart) {
            $cart["product"] = Product::where('product_id', $cart['product_id'])->first();
        }

        return response()->json(['data' => $carts, 'status' => 'ok']);
    }

    public function getTotalCartItems($user_id, Request $request)
    {
        $count = CartItem::where('user_id', $user_id)->count();
        return response()->json(['data' => $count, 'status' => 'ok']);
    }

    public function postCartItem(Request $request)
    {
        $item = CartItem::where([
            ['user_id', '=', $request->get('user_id')],
            ['product_id', '=', $request->get('product_id')],
        ]);

        if ($item->exists()) {
            $item = $item->first();
            $item->quantity = $request->get('quantity');
            $item->save();
        } else {
            $item = CartItem::create([
                'user_id' => $request->get('user_id'),
                'product_id' => $request->get('product')['product_id'],
                'quantity' => $request->get('quantity'),
            ]);
        }

        return response()->json(['data' => $item, 'status' => 'ok']);
    }

    public function deleteCartItem($user_id, $product_id, Request $request)
    {
        $item = CartItem::where([
            ['user_id', '=', $user_id],
            ['product_id', '=', $product_id],
        ])->first()->delete();

        return response()->json(['status' => 'ok']);
    }
}
