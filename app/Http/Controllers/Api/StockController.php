<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Stock;
use App\Product;
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
                ->with('category')
                ->get()
                ->each(function ($product, $key) {
                    $product->priceLatest() ? $product['price_latest'] = $product->priceLatest() : $product['price_latest'] =  array("buying_price_a" => 0, "buying_price_b" => 0, "buying_price_c"=> 0);
                    $product['price_difference'] = $product->priceDifference();
                }),
        ]);
    }

    public function postStocks(Request $request)
    {
        $stock = new Stock();
        $stock->status = 0;

        JWTAuth::parseToken()->authenticate()
            ->stocks()
            ->save($stock);

        foreach ($request->all() as $json) {
            $product = Product::find($json['product']['id']);
            $stock->products()->save($product, [
                'grade' => $json['grade'],
                'quantity' => $json['quantity'],
            ]);
        }

        return response()->json([
            'data' => $stock,
        ]);
    }

}
