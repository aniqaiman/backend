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

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
    	$path = $request->file('product_image')->store('public/images');
		if($request->ajax()){
            $products = new Product;
            $products->product_name = $request->product_name;
            $products->product_desc = $request->product_desc;
            $products->product_price = $request->product_price;
            $products->product_image = $path;
            $products->save();
            return response($products);
        }
    }

    public function getProduct()
    {
    	$products = Product::all();
	    // $users = User::all();
	    return view('product.product',compact('products'));
    }

    public function editProduct($product_id, Request $request)
    {
        $products = Product::where('product_id', $request->product_id)->first();
        return view('product.editProduct', compact('products'));
    }

    public function updateProduct(Request $request)
    {
    	$path = $request->file('product_image')->store('public/images');
        if($request->ajax()){
            $products = Product::where('product_id', $request->product_id)->first();
            $products->product_name = $request->product_name;
            $products->product_desc = $request->product_desc;
            $products->product_price = $request->product_price;
            $products->product_image = $path;
            $products->save();
            return response($products);
            }       
    }

    public function deleteProduct($product_id, Request $request)
    {
        $products = Product::find($product_id);
        $products->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('product');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
