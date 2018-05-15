<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function updateDemand(Request $request)
    {
        $product = Product::find($request->input('id'));

        if ($request->input('grade') === 'A') {
            $product->demand_a = $request->input('demand');
        } else if ($request->input('grade') === 'B') {
            $product->demand_b = $request->input('demand');
        }

        return response()->json($product);
    }
}
