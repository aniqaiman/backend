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
}