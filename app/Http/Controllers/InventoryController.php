<?php

namespace App\Http\Controllers;

use App\Order;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = DB::select("
        SELECT
            CONCAT(products.name, ' (Grade ', product_stock.grade, ')') item,
            products.id product_id,
            products.sku,
            CASE
                WHEN product_stock.grade = 'A' THEN products.demand_a
                WHEN product_stock.grade = 'B' THEN products.demand_b
                ELSE 0
            END demand,
            DATE(stocks.created_at) incoming_date,
            (
                SELECT
                    CASE
                        WHEN product_stock.grade = 'A' THEN prices.seller_price_a
                        WHEN product_stock.grade = 'B' THEN prices.seller_price_b
                    ELSE 0
                    END purchase_price
                FROM prices
                WHERE prices.date_price < stocks.created_at
                ORDER BY date_price DESC
                LIMIT 1
            ) purchase_price,
            SUM(product_stock.quantity) total_purchased
        FROM stocks
        INNER JOIN product_stock ON stocks.id = product_stock.stock_id
        INNER JOIN products ON products.id = product_stock.product_id
        GROUP BY
            DATE(stocks.created_at),
            products.name,
            products.sku,
            products.id,
            products.demand_a,
            products.demand_b,
            product_stock.grade,
            stocks.created_at
        ORDER BY
            DATE(stocks.created_at) DESC,
            CONCAT(products.name, ' (Grade ', product_stock.grade, ')')
        ");

        foreach ($inventories as $inventory) {
            $inventory->order_ids = Order::select('id')
                ->whereDate('created_at', '=', $inventory->incoming_date)
                ->whereHas('products', function ($q) use ($inventory) {
                    $q->where('id', $inventory->product_id);
                })
                ->get();

            $inventory->stocks = Stock::with('user', 'driver')
                ->whereDate('created_at', '=', $inventory->incoming_date)
                ->whereHas('products', function ($q) use ($inventory) {
                    $q->where('id', $inventory->product_id);
                })
                ->get();
        }

        // dump($inventories[0]->stocks[0]);exit;

        return view('inventories.index', compact('inventories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWastages()
    {
        return view('inventories.index_wastages', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
