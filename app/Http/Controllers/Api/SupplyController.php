<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use JWTAuth;

class SupplyController extends Controller
{
    public function getSupplies()
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->supplies()
                ->with('category'),
        ]);
    }
}
