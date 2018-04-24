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
}
