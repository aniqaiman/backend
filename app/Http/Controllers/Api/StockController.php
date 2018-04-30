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
        dump($request);
        exit;
        $stocks = $request->get('stocks');

        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->stocks()
                ->syncWithoutDetaching([
                    $request->get('product')['id'] => ['quantity' => $request->get('quantity')],
                ]),
        ]);
    }

}
