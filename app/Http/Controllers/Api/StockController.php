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
        dump($request->all());
        exit;
        $stocks = $request->input('stocks');

        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->stocks()
                ->syncWithoutDetaching([
                    $request->input('product')['id'] => ['quantity' => $request->input('quantity')],
                ]),
        ]);
    }

}
