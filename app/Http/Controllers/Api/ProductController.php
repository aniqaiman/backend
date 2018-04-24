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
    public function getProducts(Request $request)
    {
        return response()->json(
            Product::get()
        );
    }

    public function getProductById($product_id, Request $request)
    {
        return response()->json(
            Product::find($product_id)
        );
    }

    public function getProductsByCategory($category_id, Request $request)
    {
        return response()->json(
            Product::where('category_id', $category_id)->get()
        );
    }

    public function getProductsByCategoryWithPage($category_id, Request $request)
    {
        return response()->json(
            Product::where('category_id', $category_id)->paginate()
        );
    }

    public function getPrices(Request $request)
    {
        $prices = Price::orderBy("price_id", "desc")->get();

        $priceArray = [];

        foreach ($prices as $price) {
            $newprice["price_id"] = $price->price_id;
            $newprice["id"] = $price->id;
            $newprice["price"] = $price->price;
            $newprice["price2"] = $price->price2;
            $newprice["price3"] = $price->price3;
            $newprice["date_price"] = $price->date_price;

            array_push($priceArray, $newprice);
        }

        return response()->json(["data" => $priceArray, "status" => "ok"]);
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
                $product["price_c_diff"] = sizeof($product->latestPrices) > 1 ?
                round(($product->latestPrices[0]->price_c - $product->latestPrices[1]->price_c) / $product->latestPrices[1]->price_c, 2) : 0;
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
            $product["priceCDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price3 - $prices[1]->product_price3) / $prices[1]->product_price3, 2) : 0;

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
