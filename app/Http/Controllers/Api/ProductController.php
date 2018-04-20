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
        $products = Product::orderBy("id", "desc")->get();

        $productArray = [];

        foreach ($products as $product) {
            $newproduct["id"] = $product->id;
            $newproduct["name"] = $product->name;
            $newproduct["desc"] = $product->desc;
            $newproduct["short_desc"] = $product->short_desc;
            $newproduct["quantity"] = $product->quantity;
            $newproduct["image"] = $product->image;
            $newproduct["created_at"] = $product->created_at;
            $newproduct["updated_at"] = $product->updated_at;
            $newproduct["category"] = $product->category;

            array_push($productArray, $newproduct);
        }

        return response()->json(["data" => $productArray, "status" => "ok"]);
    }

    public function getProductById($product_id, Request $request)
    {
        $product = Product::where("id", $product_id)->first();
        $prices = Price::where("product_id", $product_id)
            ->orderBy("created_at", "desc")
            ->take(2)
            ->get();

        $newproduct["id"] = $product->id;
        $newproduct["name"] = $product->name;
        $newproduct["desc"] = $product->desc;
        $newproduct["short_desc"] = $product->short_desc;
        $newproduct["quantity"] = $product->quantity;
        $newproduct["image"] = $product->image;
        $newproduct["category"] = $product->category;
        $newproduct["priceA"] = $prices[0]->product_price;
        $newproduct["priceB"] = $prices[0]->product_price2;
        $newproduct["priceC"] = $prices[0]->product_price3;
        $newproduct["priceADiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price - $prices[1]->product_price) / $prices[1]->product_price, 2) : 0;
        $newproduct["priceBDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price2 - $prices[1]->product_price2) / $prices[1]->product_price2, 2) : 0;
        $newproduct["priceCDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price3 - $prices[1]->product_price3) / $prices[1]->product_price3, 2) : 0;

        return response()->json(["data" => $newproduct, "status" => "ok"]);
    }

    public function getFruit(Request $request)
    {
        $fruits = Product::where("category", 1)->get();
        $fruitArray = [];

        foreach ($fruits as $fruit) {
            $prices = Price::where("product_id", $fruit->id)
                ->orderBy("created_at", "desc")
                ->take(2)
                ->get();

            $newfruit["id"] = $fruit->id;
            $newfruit["name"] = $fruit->name;
            $newfruit["desc"] = $fruit->desc;
            $newfruit["short_desc"] = $fruit->short_desc;
            $newfruit["quantity"] = $fruit->quantity;
            $newfruit["image"] = $fruit->image;
            $newfruit["category"] = $fruit->category;
            $newfruit["priceA"] = $prices[0]->product_price;
            $newfruit["priceB"] = $prices[0]->product_price2;
            $newfruit["priceC"] = $prices[0]->product_price3;
            $newfruit["priceADiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price - $prices[1]->product_price) / $prices[1]->product_price, 2) : 0;
            $newfruit["priceBDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price2 - $prices[1]->product_price2) / $prices[1]->product_price2, 2) : 0;
            $newfruit["priceCDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price3 - $prices[1]->product_price3) / $prices[1]->product_price3, 2) : 0;

            array_push($fruitArray, $newfruit);
        }

        return response()->json(["data" => $fruitArray, "status" => "ok"]);
    }

    public function getVege()
    {
        $veges = Product::where("category", 11)->get();
        $vegeArray = [];

        foreach ($veges as $vege) {
            $prices = Price::where("product_id", $vege->id)
                ->orderBy("created_at", "desc")
                ->take(2)
                ->get();

            $newvege["id"] = $vege->id;
            $newvege["name"] = $vege->name;
            $newvege["desc"] = $vege->desc;
            $newvege["short_desc"] = $vege->short_desc;
            $newvege["quantity"] = $vege->quantity;
            $newvege["image"] = $vege->image;
            $newvege["category"] = $vege->category;
            $newvege["priceA"] = $prices[0]->product_price;
            $newvege["priceB"] = $prices[0]->product_price2;
            $newvege["priceC"] = $prices[0]->product_price3;
            $newvege["priceADiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price - $prices[1]->product_price) / $prices[1]->product_price, 2) : 0;
            $newvege["priceBDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price2 - $prices[1]->product_price2) / $prices[1]->product_price2, 2) : 0;
            $newvege["priceCDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price3 - $prices[1]->product_price3) / $prices[1]->product_price3, 2) : 0;

            array_push($vegeArray, $newvege);
        }

        return response()->json(["data" => $vegeArray, "status" => "ok"]);
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
        $products = Product::orderBy("created_at", "desc")
            ->take(10)
            ->get();

        $productArray = [];

        foreach ($products as $product) {
            $prices = Price::where("product_id", $product->id)
                ->orderBy("created_at", "desc")
                ->take(2)
                ->get();

            $newproduct["id"] = $product->id;
            $newproduct["name"] = $product->name;
            $newproduct["desc"] = $product->desc;
            $newproduct["short_desc"] = $product->short_desc;
            $newproduct["quantity"] = $product->quantity;
            $newproduct["image"] = $product->image;
            $newproduct["category"] = $product->category;
            $newproduct["priceA"] = $prices[0]->product_price;
            $newproduct["priceB"] = $prices[0]->product_price2;
            $newproduct["priceC"] = $prices[0]->product_price3;
            $newproduct["priceADiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price - $prices[1]->product_price) / $prices[1]->product_price, 2) : 0;
            $newproduct["priceBDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price2 - $prices[1]->product_price2) / $prices[1]->product_price2, 2) : 0;
            $newproduct["priceCDiff"] = sizeof($prices) > 1 ? round(($prices[0]->product_price3 - $prices[1]->product_price3) / $prices[1]->product_price3, 2) : 0;

            array_push($productArray, $newproduct);
        }

        return response()->json(["data" => $productArray, "status" => "ok"]);
    }

    public function getLastPurchaseProducts(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $lastPurchaseProducts = Product::whereHas("orders", function ($orders) use ($user) { $orders->where("user_id", $user->user_id); })
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
