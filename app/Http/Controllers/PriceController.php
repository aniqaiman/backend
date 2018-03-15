<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Product;
use App\Price;

class PriceController extends Controller
{
    public function getFruitDetail($product_id, Request $request)
    {
        $fruit = Product::where('product_id', $product_id)->first();
        $prices = Price::where('product_id', $product_id)->get();
        return view('price.fruitprice', compact('fruit','prices'));
    }

    public function createFruitPrice($product_id, Request $request)
    {
    	if($request->ajax()){
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
        return view('price.editFruitPrice', compact('prices','fruit'));
    }

    public function updateFruitPrice(Request $request)
    {
        if($request->ajax()){
            $prices = Price::where('price_id', $request->price_id)->first();
            $prices->product_id = $request->product_id;
            $prices->product_price = $request->product_price;
            $prices->date_price = $request->date_price;
            $prices->save();
            return response($prices);
            }       
    }

    public function deleteFruitPrice($price_id, Request $request)
    {
        $prices = Price::find($price_id);
        $prices->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('fruitprice');
    }


    public function createVegePrice($product_id, Request $request)
    {
        if($request->ajax()){
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
        return view('price.vegeprice', compact('vege','prices'));
    }

    public function editVegePrice($product_id, $price_id, Request $request)
    {
        $prices = Price::where('price_id', $price_id)->first();
        return view('price.editVegePrice', compact('prices'));
    }

    public function updateVegePrice(Request $request)
    {
        if($request->ajax()){
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

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
