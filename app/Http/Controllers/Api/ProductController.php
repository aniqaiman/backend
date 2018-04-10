<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Price;
use App\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $products = Product::orderBy('product_id', 'desc')->get();

        $productArray = [];

        foreach ($products as $product) {
            $newproduct["product_id"] = $product->product_id;
            $newproduct["product_name"] = $product->product_name;
            $newproduct["product_desc"] = $product->product_desc;
            $newproduct["short_desc"] = $product->short_desc;
            $newproduct["quantity"] = $product->quantity;
            $newproduct["product_image"] = $product->product_image;
            $newproduct["created_at"] = $product->created_at;
            $newproduct["updated_at"] = $product->updated_at;
            $newproduct["category"] = $product->category;

            array_push($productArray, $newproduct);
        }

        return response()->json(['data' => $productArray, 'status' => 'ok']);
    }

    public function getProductById($product_id, Request $request)
    {
        $product = Product::where('product_id', $product_id)->first();
        $price = Price::where('product_id', $product_id)->orderBy('created_at', 'desc')->take(2)->get();

        $newproduct["product_id"] = $product->product_id;
        $newproduct["product_name"] = $product->product_name;
        $newproduct["product_desc"] = $product->product_desc;
        $newproduct["short_desc"] = $product->short_desc;
        $newproduct["quantity"] = $product->quantity;
        $newproduct["product_image"] = $product->product_image;
        $newproduct["category"] = $product->category;
        $newproduct["priceA"] = $price[0]->product_price;
        $newproduct["priceB"] = $price[0]->product_price2;
        $newproduct["priceC"] = $price[0]->product_price3;
        $newproduct["priceADiff"] = $price[0]->product_price - $price[1]->product_price / $price[0]->product_price;
        $newproduct["priceBDiff"] = $price[0]->product_price2 - $price[1]->product_price2 / $price[0]->product_price2;
        $newproduct["priceCDiff"] = $price[0]->product_price3 - $price[1]->product_price3 / $price[0]->product_price3;

        return response()->json(['data' => $newproduct, 'status' => 'ok']);
    }

    public function getFruit(Request $request)
    {
        $fruits = Product::where('category', 1)->get();

        $fruitArray = [];

        foreach ($fruits as $fruit) {
            $prices = Price::where('product_id', $fruit->product_id)->orderBy('created_at', 'desc')->first();

            $newfruit["product_id"] = $fruit->product_id;
            $newfruit["product_name"] = $fruit->product_name;
            $newfruit["product_desc"] = $fruit->product_desc;
            $newfruit["short_desc"] = $fruit->short_desc;
            $newfruit["quantity"] = $fruit->quantity;
            $newfruit["product_image"] = $fruit->product_image;
            $newfruit["category"] = $fruit->category;
            $newfruit["priceA"] = $prices->product_price;
            $newfruit["priceB"] = $prices->product_price2;
            $newfruit["priceC"] = $prices->product_price3;
            $newfruit["date_price"] = $prices->date_price;

            array_push($fruitArray, $newfruit);
        }

        return response()->json(['data' => $fruitArray, 'status' => 'ok']);
    }

    public function getVege()
    {
        $veges = Product::where('category', 11)->get();

        $vegeArray = [];

        foreach ($veges as $vege) {
            $prices = Price::where('product_id', $vege->product_id)->orderBy('created_at', 'desc')->first();

            $newvege["product_id"] = $vege->product_id;
            $newvege["product_name"] = $vege->product_name;
            $newvege["product_desc"] = $vege->product_desc;
            $newvege["short_desc"] = $vege->short_desc;
            $newvege["quantity"] = $vege->quantity;
            $newvege["product_image"] = $vege->product_image;
            $newvege["category"] = $vege->category;
            $newvege["priceA"] = $prices->product_price;
            $newvege["priceB"] = $prices->product_price2;
            $newvege["priceC"] = $prices->product_price3;
            $newvege["date_price"] = $prices->date_price;

            array_push($vegeArray, $newvege);
        }

        return response()->json(['data' => $vegeArray, 'status' => 'ok']);
    }

    public function getPrices(Request $request)
    {
        $prices = Price::orderBy('price_id', 'desc')->get();

        $priceArray = [];

        foreach ($prices as $price) {
            $newprice["price_id"] = $price->price_id;
            $newprice["product_id"] = $price->product_id;
            $newprice["product_price"] = $price->product_price;
            $newprice["product_price2"] = $price->product_price2;
            $newprice["product_price3"] = $price->product_price3;
            $newprice["date_price"] = $price->date_price;

            array_push($priceArray, $newprice);
        }

        return response()->json(['data' => $priceArray, 'status' => 'ok']);
    }

    public function getNewProducts(Request $request)
    {
        $products = Product::orderBy('created_at', 'desc')->take(10)->get();

        $productArray = [];

        foreach ($products as $product) {
            $newproduct["product_id"] = $product->product_id;
            $newproduct["product_name"] = $product->product_name;
            $newproduct["product_desc"] = $product->product_desc;
            $newproduct["short_desc"] = $product->short_desc;
            $newproduct["quantity"] = $product->quantity;
            $newproduct["product_image"] = $product->product_image;
            $newproduct["created_at"] = $product->created_at;
            $newproduct["updated_at"] = $product->updated_at;
            $newproduct["category"] = $product->category;

            array_push($productArray, $newproduct);
        }

        return response()->json(['data' => $productArray, 'status' => 'ok']);
    }

    public function getBestSelling(Request $request)
    {
        // $orders = Order::where('product_id', $order->product_id)->get();

        // $orderArray = [];

        // foreach ($orders as $order)
        // {

        // }

        $orders = Order::all();
        $max = 0;

        foreach ($orders as $order) {
            $productcount = Order::where('product_id', $order->product_id)->count();

            if ($productcount > $max) {
                $max = $productcount;
            } else {
                $max = $max;
            }
        }
        return response()->json(['data' => $max, 'status' => 'ok']);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
