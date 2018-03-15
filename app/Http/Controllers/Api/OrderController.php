<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Order;
use App\Price;

class OrderController extends BaseController
{
	public function postOrder(Request $request)
	{
		$orders = Order::create([
			'user_id' => $request->get('user_id'),
			'product_id' => $request->get('product_id'),
			'item_quantity' => $request->get('item_quantity'),
			'product_price' => $request->get('product_price'),
			'promo_price' => $request->get('promo_price'),
			]);
		return response()->json(['data'=>$orders, 'status'=>'ok']);
	}

	public function getOrders(Request $request)
	{
		$orders = Order::orderBy('order_id','desc')->get();

		$orderArray = [];

		foreach ($orders as $order) 
		{
			$prices = Price::where('product_id', $order->product_id)->orderBy('created_at','desc')->first();

			$neworder["order_id"] = $order->order_id;
			$neworder["user_id"] = $order->user_id;
			$neworder["product_id"] = $order->product_id;
			$neworder["item_quantity"] = $order->item_quantity;

			$neworder["product_price"] = $prices->product_price;
			// $neworder["product_price"] = $prices->promo_price;
			
			$neworder["created_at"] = $order->created_at;

			array_push($orderArray, $neworder);
		}
		return response()->json(['data'=>$orderArray, 'status'=>'ok']);
	}
}