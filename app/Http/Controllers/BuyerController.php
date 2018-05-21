<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Session;

class BuyerController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $buyers = new User;
            $buyers->name = $request->name;
            $buyers->company_name = $request->company_name;
            $buyers->company_reg_ic_number = $request->company_reg_ic_number;
            $buyers->buss_hour = $request->buss_hour;
            $buyers->address = $request->address;
            $buyers->phonenumber = $request->phonenumber;
            $buyers->handphone_number = $request->handphone_number;
            $buyers->email = $request->email;
            $buyers->password = bcrypt($request->password);
            $buyers->group_id = 11;
            $buyers->save();
            return response($buyers);
        }
    }

    public function index()
    {
        $buyers = User::orderBy('active_counter', 'desc')
            ->where('group_id', 11)
            ->get()
            ->each(function ($buyer) {
                $buyer->products = Product::orderBy('active_counter', 'asc')
                    ->whereHas('orders', function ($order) use ($buyer) {
                        $order->where('user_id', $buyer->id);
                    })->get();
            });
        return view('buyers.index', compact('buyers'));
    }

    public function edit($user_id, Request $request)
    {
        $buyers = User::where('user_id', $user_id)->first();
        return view('buyer.editBuyer', compact('buyers'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $buyers = User::where('user_id', $request->user_id)->first();
            $buyers->name = $request->name;
            $buyers->company_name = $request->company_name;
            $buyers->company_reg_ic_number = $request->company_reg_ic_number;
            $buyers->buss_hour = $request->buss_hour;
            $buyers->address = $request->address;
            $buyers->phonenumber = $request->phonenumber;
            $buyers->handphone_number = $request->handphone_number;
            $buyers->email = $request->email;
            $buyers->password = bcrypt('$request->password');
            $buyers->save();
            return response($buyers);
        }
    }

    public function delete($user_id, Request $request)
    {
        $buyers = User::find($user_id);
        $buyers->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('buyer');
    }
}
