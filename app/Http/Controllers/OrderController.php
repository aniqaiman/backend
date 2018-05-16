<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Order;
use App\Stock;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Redirect;
use Session;

class OrderController extends Controller
{
    public function store(Request $request)
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

    public function indexOrderReceipts()
    {
        $orders = Order::where('status', 0)
            ->paginate(10, ['*'], 'buyer');

        $stocks = Stock::where('status', 0)
            ->paginate(10, ['*'], 'seller');

        return view('orders.receipts', compact('orders', 'stocks'));
    }

    public function indexOrderTrackings()
    {
        $orders = Order::whereIn('status', [1, 3])
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'buyer');

        $stocks = Stock::whereIn('status', [1, 3])
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'seller');

        $drivers = User::where('group_id', 31)
            ->get();

        return view('orders.trackings', compact('orders', 'stocks', 'drivers'));
    }

    public function indexOrderRejects()
    {
        $orders = Order::where('status', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'buyer');

        $stocks = Stock::where('status', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'seller');

        return view('orders.rejects', compact('orders', 'stocks'));
    }

    public function indexOrderTransactions()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'buyer');

        $stocks = Stock::orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'seller');

        return view('orders.transactions', compact('orders', 'stocks'));
    }

    public function indexLorries()
    {
        $ordersQuery = Order::whereNotNull('lorry_id')->get();
        $orders = [];
        foreach ($ordersQuery as $order) {
            $newOrder["date"] = $order->created_at;
            $newOrder["driver_name"] = $order->driver->name;
            $newOrder["driver_id"] = $order->driver->id;
            $newOrder["id"] = $order->id;
            $newOrder["user_name"] = $order->user->name;
            $newOrder["user_id"] = $order->user->id;
            $newOrder["user_address"] = $order->user->address;
            $newOrder["latitude"] = $order->user->latitude;
            $newOrder["longitude"] = $order->user->longitude;
            $weight = DB::table('order_product')->where('order_id', $order->id)->sum('quantity');
            $newOrder["tonnage"] = $weight;
            array_push($orders, $newOrder);
        }
        return view('orders.lorries', compact('orders'));
    }

    public function assignDriverOrder(Request $request)
    {
        $order = Order::find($request->id);

        $order->lorry_id = $request->lorry_id;
        $order->save();
        return response($order);
    }

    public function updateApproveBuyerOrder(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 1;
        $order->save();

        foreach ($order->products as $product) {
            if ($product->pivot->grade === "A") {
                $product->quantity_a -= $product->pivot->quantity;

                $inventory = Inventory::where([
                    ['product_id', $product->id],
                    ['grade', $product->pivot->grade],
                    ['created_at', '>=', Carbon::today()],
                ])->first();

                if (is_null($inventory)) {
                    $inventory = new Inventory();
                    $inventory->product_id = $product->id;
                    $inventory->price_id = $product->priceLatest()->id;
                    $inventory->grade = $product->pivot->grade;
                    $inventory->save();

                    $inventory->orders()->syncWithoutDetaching([$order->id]);
                } else {
                    $inventory->orders()->syncWithoutDetaching([$order->id]);
                }
            } else if ($product->pivot->grade === "B") {
                $product->quantity_b -= $product->pivot->quantity;
            }

            $product->save();
        }
        exit;

        return response($order);
    }

    public function updateApproveSellerStock(Request $request)
    {
        $stock = Stock::find($request->id);
        $stock->status = 1;
        $stock->save();

        foreach ($stock->products as $product) {
            if ($product->pivot->grade === "A") {
                $product->quantity_a += $product->pivot->quantity;

                $inventory = Inventory::where([
                    ['product_id', $product->id],
                    ['grade', $product->pivot->grade],
                    ['created_at', '>=', Carbon::today()],
                ])->first();

                if (is_null($inventory)) {
                    $inventory = new Inventory();
                    $inventory->product_id = $product->id;
                    $inventory->price_id = $product->priceLatest()->id;
                    $inventory->grade = $product->pivot->grade;
                    $inventory->save();

                    $inventory->stocks()->syncWithoutDetaching([$stock->id]);
                } else {
                    $inventory->stocks()->syncWithoutDetaching([$stock->id]);
                }
            } else if ($product->pivot->grade === "B") {
                $product->quantity_b += $product->pivot->quantity;
            }

            $product->save();
        }
        exit;

        return response($stock);
    }

    public function updateRejectBuyerOrder(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 2;
        $order->feedback_topic = $request->topic;
        $order->feedback_description = $request->description;
        $order->feedback_read = 0;
        $order->save();

        return response($order);
    }

    public function updateRejectSellerStock(Request $request)
    {
        $stock = Stock::find($request->id);
        $stock->status = 2;
        $stock->feedback_topic = $request->topic;
        $stock->feedback_description = $request->description;
        $stock->feedback_read = 0;
        $stock->save();

        return response($stock);
    }

    public function updatePendingOrderStock(Request $request)
    {
        if ($request->type === "order") {
            $order = Order::find($request->id);
            $order->status = 1;
            $order->save();
            return response($order);
        } else if ($request->type === "stock") {
            $stock = Stock::find($request->id);
            $stock->status = 1;
            $stock->save();
            return response($stock);
        }
    }

    public function updateCompleteOrderStock(Request $request)
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

    public function show(Request $request, $order_id)
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

    public function edit($order_id, Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        return view('order.editOrder', compact('order'));
    }

    public function update(Request $request)
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

    public function delete($order_id, Request $request)
    {
        $order = Order::find($order_id);
        $order->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('driver');
    }
}
