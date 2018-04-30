<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Stock;
use Illuminate\Http\Request;
use JWTAuth;

class StockController extends Controller
{
    public function getStocks(Request $request)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->stocks()
                ->orderBy('created_at', 'desc')
                ->get()
                ->each(function ($stock, $key) {
                    $stock['total_price'] = $stock->totalPrice();
                }),
        ]);
    }

    public function getStockDetails(Request $request, $stock_id)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->stocks()
                ->find($stock_id)
                ->products()
                ->get(),
        ]);
    }

    public function postStocks(Request $request)
    {
        $stock = new Stock();
        $stock->status = 0;

        JWTAuth::parseToken()->authenticate()
            ->stocks()
            ->save($stock);

        foreach ($request->all() as $key => $product) {
            $stock->products()->syncWithoutDetaching([
                $product['product']['id'] => [
                    'grade' => $product['grade'],
                    'quantity' => $product['quantity'],
                ],
            ]);
        }

        return response()->json([
            'data' => $stock,
        ]);
    }

}
