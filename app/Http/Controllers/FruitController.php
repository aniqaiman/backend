<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Redirect;
use Session;

class FruitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createFruit(Request $request)
    {
        $path = $request->file('product_image')->store('public/images');
        if ($request->ajax()) {
            $fruits = new Product;
            $fruits->product_name = $request->product_name;
            $fruits->product_desc = $request->product_desc;
            $fruits->quantity = $request->quantity;
            $fruits->short_desc = $request->short_desc;
            $fruits->product_image = $path;
            $fruits->category = 1;
            $fruits->save();
            return response($fruits);
        }
    }

    public function index()
    {
        $fruits = Product::where('category_id', 1)->get();
        $categories = Category::all();
        return view('product.fruit', compact('fruits', 'categories'));
    }

    public function editFruit($product_id, Request $request)
    {
        $fruits = Product::where('product_id', $product_id)->first();
        $categories = Category::all();
        return view('product.editFruit', compact('fruits', 'categories'));
    }

    public function updateFruit(Request $request)
    {
        $path = $request->file('product_image')->store('public/images');
        if ($request->ajax()) {
            $fruits = Product::where('product_id', $request->product_id)->first();
            $fruits->product_name = $request->product_name;
            $fruits->product_desc = $request->product_desc;
            $fruits->quantity = $request->quantity;
            // $fruits->product_price = $request->product_price;
            // $fruits->category = $request->category;
            $fruits->short_desc = $request->short_desc;
            $fruits->product_image = $path;
            $fruits->save();
            return response($fruits);
        }
    }

    public function deleteFruit($product_id, Request $request)
    {
        $fruits = Product::find($product_id);
        $fruits->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('fruit');
    }
}
