<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use JWTAuth;

class CartController extends Controller
{
    public function getCartItems(Request $request)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->carts()
                ->with('category')
                ->get(),
        ]);
    }

    public function getTotalItems(Request $request)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->totalCartItems(),
        ]);
    }

    public function getTotalPrice(Request $request)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->totalCartPrice(),
        ]);
    }

    public function postCartItem(Request $request)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->carts()
                ->syncWithoutDetaching([
                    $request->get('product')['id'] => ['quantity' => $request->get('quantity')],
                ]),
        ]);
    }

    public function deleteCartItem($product_id, Request $request)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->carts()
                ->detach($product_id),
        ]);
    }

    public function postConfirm(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $order = new Order;
        $order->status = 0;
        $user->orders()->save($order);

        foreach ($user->carts()->get() as $cart) {
            $order->products()->syncWithoutDetaching([
                $cart->id => ['quantity' => $cart->pivot->quantity],
            ]);
        }

        $user->carts()->detach();

        return response()->json([
            'data' => $order,
        ]);
    }
}
