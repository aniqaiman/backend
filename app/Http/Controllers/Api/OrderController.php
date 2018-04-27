<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->orders()
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }

    public function getOrderDetails(Request $request, $order_id)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->orders()
                ->find($order_id)
                ->products()
                ->get(),
        ]);
    }
}
