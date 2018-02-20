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
			$newproduct["category"] = $product->category;
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
		$newproduct["category"] = $product->category;
		$newproduct["created_at"] = $product->created_at;
		$newproduct["updated_at"] = $product->updated_at;

		return response()->json(['data'=>$newproduct, 'status'=>'ok']);
	}

	public function getFruit()
	{
		$fruits = Product::where('category', 1)->get();

		$fruitArray = [];

		foreach ($fruits as $fruit)
		{
			$newfruit["product_id"] = $fruit->product_id;
			$newfruit["product_name"] = $fruit->product_name;
			$newfruit["product_desc"] = $fruit->product_desc;
			$newfruit["product_price"] = $fruit->product_price;
			$newfruit["product_image"] = $fruit->product_image;
			$newfruit["category"] = $fruit->category;
			$newfruit["created_at"] = $fruit->created_at;
			$newfruit["updated_at"] = $fruit->updated_at;

			array_push($fruitArray, $newfruit);
		}

		return response()->json(['data'=>$fruitArray, 'status'=>'ok']);
	}

	// public function getFruitById($product_id, Request $request)
	// {
	// 	$fruit = Product::where('category', $product_id)->first();

	// 		$newfruit["product_id"] = $fruit->product_id;
	// 		$newfruit["product_name"] = $fruit->product_name;
	// 		$newfruit["product_desc"] = $fruit->product_desc;
	// 		$newfruit["product_price"] = $fruit->product_price;
	// 		$newfruit["product_image"] = $fruit->product_image;
	// 		$newfruit["category"] = $fruit->category;
	// 		$newfruit["created_at"] = $fruit->created_at;
	// 		$newfruit["updated_at"] = $fruit->updated_at;

	// 	return response()->json(['data'=>$newfruit, 'status'=>'ok']);
	// }

	public function getVege()
	{
		$veges = Product::where('category', 11)->get();

		$vegeArray = [];

		foreach ($veges as $vege)
		{
			$newvege["product_id"] = $vege->product_id;
			$newvege["product_name"] = $vege->product_name;
			$newvege["product_desc"] = $vege->product_desc;
			$newvege["product_price"] = $vege->product_price;
			$newvege["product_image"] = $vege->product_image;
			$newvege["category"] = $vege->category;
			$newvege["created_at"] = $vege->created_at;
			$newvege["updated_at"] = $vege->updated_at;

			array_push($vegeArray, $newvege);
		}

		return response()->json(['data'=>$vegeArray, 'status'=>'ok']);
	}

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
}