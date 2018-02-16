<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Product;

class ProductController extends BaseController
{
	public function getProduct(Request $request)
	{
		$products = Product::orderBy('product_id', 'desc')->get();

		$productArray = [];

		foreach ($products as $product)
		{
			$newproduct["product_id"] = $product->product_id;
			$newproduct["product_name"] = $product->product_name;
			$newproduct["product_desc"] = $product->product_desc;
			$newproduct["product_price"] = $product->product_price;
			$newproduct["product_image"] = $product->product_image;
			$newproduct["created_at"] = $product->created_at;
			$newproduct["updated_at"] = $product->updated_at;

			array_push($productArray, $newproduct);
		}

		return response()->json(['data'=>$productArray, 'status'=>'ok']);
	}

	public function getProductById($product_id, Request $request)
    {
        $product = Product::where('product_id', $product_id)->first();

            $newproduct["product_id"] = $product->product_id;
			$newproduct["product_name"] = $product->product_name;
			$newproduct["product_desc"] = $product->product_desc;
			$newproduct["product_price"] = $product->product_price;
			$newproduct["product_image"] = $product->product_image;
			$newproduct["created_at"] = $product->created_at;
			$newproduct["updated_at"] = $product->updated_at;

            return response()->json(['data'=>$newproduct, 'status'=>'ok']);
    }

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
}