<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Order;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
    	if($request->ajax()){
            $orders = new Order;
            $orders->user_id = $request->user_id;
            $orders->item_id = $request->item_id;
            $orders->item_quantity = $request->item_quantity;
            $orders->product_price = $request->product_price;
            $orders->promo_price = $request->promo_price;
            $orders->save();
            return response($orders);
		}
    }

    public function getOrder()
    {
    	$orders = Order::all();
    	return view('order.order', compact('orders'));
    }

    public function editOrder($order_id, Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        return view('order.editOrder', compact('order'));
    }

    public function updateOrder(Request $request)
    {
    	if($request->ajax()){
    	    $orders = Order::where('order_id', $request->order_id)->first();
            $orders->user_id = $request->user_id;
            $orders->item_id = $request->item_id;
            $orders->item_quantity = $request->item_quantity;
            $orders->product_price = $request->product_price;
            $orders->promo_price = $request->promo_price;
            $orders->save();
            return response($orders);
		}
    }

    public function deleteOrder($order_id, Request $request)
    {
        $order = Order::find($order_id);
        $order->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('driver');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
