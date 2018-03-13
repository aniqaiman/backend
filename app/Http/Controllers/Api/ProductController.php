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
use App\Price;

class ProductController extends BaseController
{
	public function getProducts(Request $request)
	{
		$products = Product::orderBy('product_id', 'desc')->get();

		$productArray = [];

		foreach ($products as $product)
		{
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

		return response()->json(['data'=>$productArray, 'status'=>'ok']);
	}

	public function getProductById($product_id, Request $request)
	{
		$product = Product::where('product_id', $product_id)->first();
		$prices = Price::where('product_id', $product_id)->orderBy('created_at','desc')->take(1)->get();

		$newproduct["product_id"] = $product->product_id;
		$newproduct["product_name"] = $product->product_name;
		$newproduct["product_desc"] = $product->product_desc;
		$newproduct["short_desc"] = $product->short_desc;
		$newproduct["quantity"] = $product->quantity;
		$newproduct["product_image"] = $product->product_image;
		$newproduct["category"] = $product->category;
		$newproduct["created_at"] = $product->created_at;
		$newproduct["updated_at"] = $product->updated_at;

		$priceArray = [];

		foreach ($prices as $newprice) 
		{
			$productprice["product_price"] = $newprice->product_price;
			$productprice["product_price2"] = $newprice->product_price2;
			$productprice["product_price3"] = $newprice->product_price3;
			$productprice["date"] = $newprice->date_price;

			array_push($priceArray, $productprice);
		}
		$newproduct["prices"] = $priceArray;

		return response()->json(['data'=>$newproduct, 'status'=>'ok']);
	}

	public function getFruit(Request $request)
	{
		$fruits = Product::where('category', 1)->get();

		$fruitArray = [];

		foreach ($fruits as $fruit)
		{
			$prices = Price::where('product_id', $fruit->product_id)->orderBy('created_at','desc')->first();

			$newfruit["product_id"] = $fruit->product_id;
			$newfruit["product_name"] = $fruit->product_name;
			$newfruit["product_desc"] = $fruit->product_desc;
			$newfruit["short_desc"] = $fruit->short_desc;
			$newfruit["quantity"] = $fruit->quantity;
			$newfruit["product_image"] = $fruit->product_image;
			$newfruit["category"] = $fruit->category;
			$newfruit["created_at"] = $fruit->created_at;
			$newfruit["updated_at"] = $fruit->updated_at;

			$newfruit["product_price"] = $prices;

			// $priceArray = [];

		// foreach ($fruit->prices as $newprice) 
		// {
		// 	$productprice["product_price"] = $newprice->product_price;
		// 	$productprice["product_price2"] = $newprice->product_price2;
		// 	$productprice["product_price3"] = $newprice->product_price3;
		// 	$productprice["date"] = $newprice->date_price;

		// 	array_push($priceArray, $productprice);
		// }
		// $newproduct["prices"] = $priceArray;

			array_push($fruitArray, $newfruit);
		}

		return response()->json(['data'=>$fruitArray, 'status'=>'ok']);
	}
 
	public function getVege()
	{
		$veges = Product::where('category', 11)->get();

		$vegeArray = [];

		foreach ($veges as $vege)
		{
			$newvege["product_id"] = $vege->product_id;
			$newvege["product_name"] = $vege->product_name;
			$newvege["product_desc"] = $vege->product_desc;
			$newvege["short_desc"] = $vege->short_desc;
			$newvege["quantity"] = $vege->quantity;
			$newvege["product_image"] = $vege->product_image;
			$newvege["category"] = $vege->category;
			$newvege["created_at"] = $vege->created_at;
			$newvege["updated_at"] = $vege->updated_at;

			$priceArray = [];

		foreach ($vege->prices as $newprice) 
		{
			$productprice["product_price"] = $newprice->product_price;
			$productprice["product_price2"] = $newprice->product_price2;
			$productprice["product_price3"] = $newprice->product_price3;
			$productprice["date"] = $newprice->date_price;

			array_push($priceArray, $productprice);
		}
		$newproduct["prices"] = $priceArray;

			array_push($vegeArray, $newvege);
		}

		return response()->json(['data'=>$vegeArray, 'status'=>'ok']);
	}

	public function getPrices(Request $request)
	{
		$prices = Price::orderBy('price_id', 'desc')->get();

		$priceArray = [];

		foreach ($prices as $price)
		{
			$newprice["price_id"] = $price->price_id;
			$newprice["product_id"] = $price->product_id;
			$newprice["product_price"] = $price->product_price;
			$newprice["product_price2"] = $price->product_price2;
			$newprice["product_price3"] = $price->product_price3;
			$newprice["date_price"] = $price->date_price;

			array_push($priceArray, $newprice);
		}

		return response()->json(['data'=>$priceArray, 'status'=>'ok']);
	}

	public function getNewProducts(Request $request)
	{
		$products = Product::orderBy('created_at', 'desc')->get();

		$productArray = [];

		foreach ($products as $product)
		{
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

		return response()->json(['data'=>$productArray, 'status'=>'ok']);
	}

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
}