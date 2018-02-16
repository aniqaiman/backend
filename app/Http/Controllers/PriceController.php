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
    public function createPrice(Request $request)
    {
    	if($request->ajax()){
			return response(Price::create($request->all()));
		}
    }

    public function getPrice()
    {
    	$prices = Price::all();
    	$products = Product::all();
	    return view('price.price',compact('prices','products'));
    }

    public function editPrice($price_id, Request $request)
    {
        $prices = Price::where('price_id', $request->price_id)->first();
        return view('price.editPrice', compact('prices'));
    }

    public function updatePrice(Request $request)
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

    public function deletePrice($price_id, Request $request)
    {
        $prices = Price::find($price_id);
        $prices->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('price');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
