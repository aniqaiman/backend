<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Redirect;
use Session;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        if ($request->ajax()) {
            $orders = new Order;
            $orders->user_id = $request->user_id;
            $orders->product_id = $request->product_id;
            $orders->item_quantity = $request->item_quantity;
            $orders->product_price = $request->product_price;
            $orders->promo_price = $request->promo_price;
            $orders->save();
            return response($orders);
        }
    }

    public function getOrderReceipts()
    {
        $orders = Order::where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        $stocks = Stock::where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.receipts', compact('orders', 'stocks'));
    }

    public function getOrderTrackings()
    {
        $orders = Order::whereNotIn('status', [0, 2])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.trackings', compact('orders'));
    }

    public function getOrderRejects()
    {
        $orders = Order::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.rejects', compact('orders'));
    }

    public function approveOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 1;
        $order->save();

        foreach ($order->products() as $product) {
            if ($product->pivot) {
                # code...
            }
        }

        return response($order);
    }

    public function updateStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        return response($order);
    }

    public function editOrder($order_id, Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        return view('order.editOrder', compact('order'));
    }

    public function updateOrder(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::where('order_id', $request->order_id)->first();
            $orders->user_id = $request->user_id;
            $orders->product_id = $request->product_id;
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
}
