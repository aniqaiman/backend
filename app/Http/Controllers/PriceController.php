<?php

namespace App\Http\Controllers;

use App\Price;
use App\Product;
use Illuminate\Http\Request;
use Redirect;
use Session;

class PriceController extends Controller
{
    public function index()
    {
        $productQuery = Product::all();
        $products = [];
        foreach ($productQuery as $product) {

            $product_prices = Price::where('product_id',$product->id)->where('date_price', date("Y-m-d"))->get();
            $newProd["id"] = $product["id"];
            $newProd["name"] = $product["name"];
            $product_prices["selling_price_a"] ? $newProd["selling_price_a"] = $product_prices["selling_price_a"] : $newProd["selling_price_a"] = 0 ;
            $product_prices["selling_price_b"] ? $newProd["selling_price_b"]  = $product_prices["selling_price_b"] : $newProd["selling_price_b"] = 0 ;
            $product_prices["buying_price_b"] ? $newProd["buying_price_b"] = $product_prices["buying_price_b"] : $newProd["buying_price_b"] = 0;
            $product_prices["buying_price_a"] ? $newProd["buying_price_a"] = $product_prices["buying_price_a"] : $newProd["buying_price_a"] = 0;
            array_push($products , $newProd);

        }
        return view('prices.index', compact('products'));
    }

    public function indexPromos()
    {
        return view('prices.index_promos', []);
    }

    public function indexHistories()
    {
        return view('prices.index_histories', []);
    }

    public function getFruitDetail($product_id, Request $request)
    {
        $fruit = Product::where('id', $product_id)->first();
        $prices = Price::where('product_id', $product_id)->orderBy('price_id', 'desc')->get();
        $latestPrice = Price::where('product_id', $product_id)->orderBy('price_id', 'desc')->first();
        return view('price.fruitprice', compact('fruit', 'prices', 'latestPrice'));
    }

    public function createFruitPrice($product_id, Request $request)
    {
        if ($request->ajax()) {
            $price = new Price;
            $price->product_id = $product_id;
            $price->product_price = $request->product_price;
            $price->product_price2 = $request->product_price2;
            $price->product_price3 = $request->product_price3;
            $price->date_price = $request->date_price;
            $price->save();
            return response($price);
        }
    }

    public function editFruitPrice($product_id, $price_id, Request $request)
    {
        $fruit = Product::where('product_id', $product_id)->first();
        $prices = Price::where('price_id', $price_id)->first();
        return view('price.editFruitPrice', compact('prices', 'fruit'));
    }

    public function updateFruitPrice(Request $request)
    {
        if ($request->ajax()) {
            $product_price = Price::where('product_id', $request->product_id)->where('date_price',$request->date)->first();
            if (!$product_price){
        $product_price = new Price();
        $product_price->product_id = $request->product_id;
        $product_price->date_price = $request->date;
    }
    if($request->selling_price_a){
            $product_price->selling_price_a = $request->selling_price_a;
        } 
        if ($request->selling_price_b){

         $product_price->selling_price_b = $request->selling_price_b;
        }
        if ($request->buying_price_a){
            $product_price->buying_price_a = $request->buying_price_a;
        }
        if ($request->buying_price_b){
            $product_price->buying_price_b = $request->buying_price_b;
        }
        $product_price->save();
            return response($product_price);
        }
    }

    public function deleteFruitPrice($price_id, Request $request)
    {
        $price = Price::find($price_id);
        $price->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('fruit/' . $price->product_id . '/detail');
    }

    public function createVegePrice($product_id, Request $request)
    {
        if ($request->ajax()) {
            $price = new Price;
            $price->product_id = $product_id;
            $price->product_price = $request->product_price;
            $price->product_price2 = $request->product_price2;
            $price->product_price3 = $request->product_price3;
            $price->date_price = $request->date_price;
            $price->save();
            return response($price);
        }
    }

    public function getVegeDetail($product_id, Request $request)
    {
        $vege = Product::where('product_id', $product_id)->first();
        $prices = Price::where('product_id', $product_id)->get();
        return view('price.vegeprice', compact('vege', 'prices'));
    }

    public function editVegePrice($product_id, $price_id, Request $request)
    {
        $prices = Price::where('price_id', $price_id)->first();
        return view('price.editVegePrice', compact('prices'));
    }

    public function updateVegePrice(Request $request)
    {
        if ($request->ajax()) {
            $prices = Price::where('price_id', $request->price_id)->first();
            $prices->product_id = $request->product_id;
            $prices->product_price = $request->product_price;
            $prices->date_price = $request->date_price;
            $prices->save();
            return response($prices);
        }
    }

    public function deleteVegePrice($price_id, Request $request)
    {
        $prices = Price::find($price_id);
        $prices->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('vegeprice');
    }
}
