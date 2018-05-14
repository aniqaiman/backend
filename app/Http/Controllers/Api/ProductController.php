<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Price;
use App\Product;
use DB;
use Illuminate\Http\Request;
use JWTAuth;

class ProductController extends Controller
{
    public function getFruits()
    {
        return response()->json([
            "data" => (new Product())->full(1)
        ]);
    }

    public function getVegetables()
    {
        return response()->json([
            "data" => (new Product())->full(11)
        ]);
    }

    public function getFruitsByPage($page)
    {
        return response()->json(
            (new Product())->full(1)->paginate(30)
        );
    }

    public function getVegetablesByPage($page)
    {
        return response()->json(
            (new Product())->full(11)->paginate(30)
        );
    }

    public function getNewProducts(Request $request)
    {
        $products = Product::with("latestPrices")
            ->orderBy("created_at", "desc")
            ->take(10)
            ->get()
            ->each(function ($product) {
                $product["price_a_diff"] = sizeof($product->latestPrices) > 1 ?
                round(($product->latestPrices[0]->price_a - $product->latestPrices[1]->price_a) / $product->latestPrices[1]->price_a, 2) : 0;
                $product["price_b_diff"] = sizeof($product->latestPrices) > 1 ?
                round(($product->latestPrices[0]->price_b - $product->latestPrices[1]->price_b) / $product->latestPrices[1]->price_b, 2) : 0;
            });

        return response()->json([
            "data" => $products,
        ]);
    }

    public function getLastPurchaseProducts(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $lastPurchaseProducts = Product::whereHas("orders", function ($orders) use ($user) {$orders->where("user_id", $user->user_id);})
            ->select("id")
            ->distinct()
            ->take(10)
            ->get();

        $productArray = [];

        foreach ($lastPurchaseProducts as $product) {
            $product = Product::find($product->id);
            $prices = Price::where("product_id", $product->id)
                ->orderBy("created_at", "desc")
                ->take(2)
                ->get();

            $product["priceA"] = $prices[0]->product_price;
            $product["priceB"] = $prices[0]->product_price2;
            $product["priceC"] = $prices[0]->product_price3;
            $product["priceADiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price - $prices[1]->product_price) / $prices[1]->product_price, 2) : 0;
            $product["priceBDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price2 - $prices[1]->product_price2) / $prices[1]->product_price2, 2) : 0;

            array_push($productArray, $product);
        }

        return response()->json(["data" => $productArray, "status" => "ok"]);
    }

    public function getBestSellingProducts(Request $request)
    {
        $bestSellingProducts = OrderItem::select(DB::raw("product_id, count(*) as product_count"))
            ->groupBy("product_id")
            ->orderBy("product_count", "desc")
            ->take(10)
            ->get();

        $productArray = [];

        foreach ($bestSellingProducts as $product) {
            $product = Product::find($product->id);
            $prices = Price::where("product_id", $product->id)
                ->orderBy("created_at", "desc")
                ->take(2)
                ->get();

            $product["priceA"] = $prices[0]->product_price;
            $product["priceB"] = $prices[0]->product_price2;
            $product["priceC"] = $prices[0]->product_price3;
            $product["priceADiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price - $prices[1]->product_price) / $prices[1]->product_price, 2) : 0;
            $product["priceBDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price2 - $prices[1]->product_price2) / $prices[1]->product_price2, 2) : 0;
            $product["priceCDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price3 - $prices[1]->product_price3) / $prices[1]->product_price3, 2) : 0;

            array_push($productArray, $product);
        }

        return response()->json(["data" => $productArray, "status" => "ok"]);
    }

}
