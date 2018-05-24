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
                ->full(),
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
                    $request->input('product')['id'] => [
                        'quantity' => $request->input('quantity'),
                        'grade' => $request->input('grade'),
                    ],
                ]),
        ]);
    }

    public function deleteCartItem(Request $request, $product_id)
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
                $cart->id => [
                    'quantity' => $cart->pivot->quantity,
                    'grade' => $cart->pivot->grade,
                ],
            ]);
        }

        $user->carts()->detach();

        foreach ($order->products as $product) {
            $product->active_counter += 1;
            $product->save();
        }

        $user->active_counter += 1;
        $user->save();
        
        return response()->json([
            'data' => $order,
        ]);
    }
}
