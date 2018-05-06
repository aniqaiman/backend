<?php

namespace App\Http\Controllers;

use App\Order;
use App\Stock;
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

    public function getOrderReceipts(Request $request)
    {
        $orders = Order::where('status', 0)
            ->paginate(10, ['*'], 'buyer');

        $stocks = Stock::where('status', 0)
            ->paginate(10, ['*'], 'seller');

        return view('orders.receipts', compact('orders', 'stocks'));
    }

    public function getOrderTrackings(Request $request)
    {
        $orders = Order::whereIn('status', [1, 3])
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'buyer');

        $stocks = Stock::whereIn('status', [1, 3])
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'seller');

        return view('orders.trackings', compact('orders', 'stocks'));
    }

    public function getOrderRejects(Request $request)
    {
        $orders = Order::where('status', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'buyer');

        $stocks = Stock::where('status', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'seller');

        return view('orders.rejects', compact('orders', 'stocks'));
    }

    public function approveBuyerOrder(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 1;
        $order->save();

        foreach ($order->products as $product) {
            if ($product->pivot->grade === "A") {
                $product->quantity_a -= $product->pivot->quantity;
            } else if ($product->pivot->grade === "B") {
                $product->quantity_b -= $product->pivot->quantity;
            } else if ($product->pivot->grade === "C") {
                $product->quantity_c -= $product->pivot->quantity;
            }

            $product->save();
        }

        return response($order);
    }

    public function approveSellerStock(Request $request)
    {
        $stock = Stock::find($request->id);
        $stock->status = 1;
        $stock->save();

        foreach ($stock->products as $product) {
            if ($product->pivot->grade === "A") {
                $product->quantity_a += $product->pivot->quantity;
            } else if ($product->pivot->grade === "B") {
                $product->quantity_b += $product->pivot->quantity;
            } else if ($product->pivot->grade === "C") {
                $product->quantity_c += $product->pivot->quantity;
            }

            $product->save();
        }

        return response($stock);
    }

    public function rejectBuyerOrder(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 2;
        $order->feedback_topic = $request->topic;
        $order->feedback_description = $request->description;
        $order->feedback_read = 0;
        $order->save();

        return response($order);
    }

    public function rejectSellerStock(Request $request)
    {
        $stock = Stock::find($request->id);
        $stock->status = 2;
        $stock->feedback_topic = $request->topic;
        $stock->feedback_description = $request->description;
        $stock->feedback_read = 0;
        $stock->save();

        return response($stock);
    }

    public function completeOrderStock(Request $request)
    {
        if ($request->type === "order") {
            $order = Order::find($request->id);
            $order->status = 3;
            $order->save();
            return response($order);
        } else if ($request->type === "stock") {
            $stock = Stock::find($request->id);
            $stock->status = 3;
            $stock->save();
            return response($stock);
        }
    }

    public function getOrderDetails(Request $request, $order_id)
    {
        return response()->json([
            'data' => Order::find($order_id)
                ->products()
                ->with('category')
                ->get()
                ->each(function ($product, $key) {
                    $product['price_latest'] = $product->priceLatest();
                    $product['price_difference'] = $product->priceDifference();
                }),
        ]);
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
