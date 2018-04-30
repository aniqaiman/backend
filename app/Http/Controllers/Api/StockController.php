<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Stock;
use Illuminate\Http\Request;
use JWTAuth;

class StockController extends Controller
{
    public function postStocks(Request $request)
    {
        $stocks = $request->all();
        $ids = array_column($stocks, 'product.id');
        dump($ids);
        exit;

        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->stocks()
                ->syncWithoutDetaching([
                    $request->input('product')['id'] => ['quantity' => $request->input('quantity')],
                ]),
        ]);
    }

}
