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
    public function getMinimalProducts()
    {
        return response()->json([
            "data" => Product::getMinimal(),
        ]);
    }

    public function getFruits()
    {
        return response()->json([
            "data" => Product::getFullByCategory(1),
        ]);
    }

    public function getVegetables()
    {
        return response()->json([
            "data" => Product::getFullByCategory(11),
        ]);
    }

    public function getFruitsByPage()
    {
        return response()->json(
            Product::getFullByCategory(1)->paginate(30)
        );
    }

    public function getVegetablesByPage()
    {
        return response()->json(
            Product::getFullByCategory(11)->paginate(30)
        );
    }

    public function getMinimalFruitsByPage()
    {
        return response()->json(
            Product::getMinimalByCategory(1)->paginate(30)
        );
    }

    public function getMinimalVegetablesByPage()
    {
        return response()->json(
            Product::getMinimalByCategory(11)->paginate(30)
        );
    }

    public function getMinimalFruits()
    {
        return response()->json([
            "data" => Product::getMinimalByCategory(1),
        ]);
    }

    public function getMinimalVegetables()
    {
        return response()->json([
            "data" => Product::getMinimalByCategory(11),
        ]);
    }

    public function getNewProducts(Request $request)
    {
        $products = Product::with("category")
            ->whereHas('promotions', function ($promotion) {
                $promotion->whereRaw('total_sold < quantity');
            })
            ->getWithPrice();

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
