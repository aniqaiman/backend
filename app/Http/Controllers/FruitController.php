<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Product;
use App\Category;
use App\Price;

class FruitController extends Controller
{
    public function createFruit(Request $request)
    {
    	$path = $request->file('product_image')->store('public/images');
		if($request->ajax()){
            $fruits = new Product;
            $fruits->product_name = $request->product_name;
            $fruits->product_desc = $request->product_desc;
            $fruits->quantity = $request->quantity;
            // $fruits->product_price = $request->product_price;
            // $fruits->category = $request->category;
            $fruits->short_desc = $request->short_desc;
            $fruits->product_image = $path;
            $fruits->category = 1;
            $fruits->save();
            return response($fruits);
        }
    }

    public function getFruit()
    {
    	$fruits = Product::where('category', 1)->get();
	    $categories = Category::all();
	    return view('product.fruit',compact('fruits','categories'));
    }

    public function editFruit($product_id, Request $request)
    {
        $fruits = Product::where('product_id', $product_id)->first();
        $categories = Category::all();
        return view('product.editFruit', compact('fruits','categories'));
    }

    public function updateFruit(Request $request)
    {
    	$path = $request->file('product_image')->store('public/images');
        if($request->ajax()){
            $fruits = Product::where('product_id', $request->product_id)->first();
            $fruits->product_name = $request->product_name;
            $fruits->product_desc = $request->product_desc;
            $fruits->quantity = $request->quantity;
            // $fruits->product_price = $request->product_price;
            // $fruits->category = $request->category;
            $fruits->short_desc = $request->short_desc;
            $fruits->product_image = $path;
            $fruits->save();
            return response($fruits);
            }       
    }

    public function deleteFruit($product_id, Request $request)
    {
        $fruits = Product::find($product_id);
        $fruits->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('fruit');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
