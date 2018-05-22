<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Redirect;
use Session;

class VegetableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $path = $request->file('product_image')->store('public/images');
        if ($request->ajax()) {
            $vegs = new Product;
            $vegs->product_name = $request->product_name;
            $vegs->product_desc = $request->product_desc;
            $vegs->quantity = $request->quantity;
            // $vegs->product_price = $request->product_price;
            $vegs->short_desc = $request->short_desc;
            $vegs->product_image = $path;
            $vegs->category = 11;
            $vegs->save();
            return response($vegs);
        }
    }

    public function index()
    {
        $vegs = Product::where('category', 11)->get();
        $categories = Category::all();
        return view('product.vege', compact('vegs', 'categories'));
    }

    public function editVege($product_id, Request $request)
    {
        $vegs = Product::where('product_id', $product_id)->first();
        // $categories = Category::all();
        return view('product.editVege', compact('vegs'));
    }

    public function update(Request $request)
    {
        $path = $request->file('product_image')->store('public/images');
        if ($request->ajax()) {
            $vegs = Product::where('product_id', $request->product_id)->first();
            $vegs->product_name = $request->product_name;
            $vegs->product_desc = $request->product_desc;
            $vegs->quantity = $request->quantity;
            $vegs->short_desc = $request->short_desc;
            // $vegs->product_price = $request->product_price;
            // $vegs->category = $request->category;
            $vegs->product_image = $path;
            $vegs->save();
            return response($vegs);
        }
    }

    public function delete($product_id, Request $request)
    {
        $vegs = Product::find($product_id);
        $vegs->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('vege');
    }
}
