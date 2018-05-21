<?php

namespace App\Http\Controllers;

use App\Capacity;
use App\Type;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Redirect;
use Session;

class SellerController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $sellers = new User;
            $sellers->name = $request->name;
            $sellers->company_name = $request->company_name;
            $sellers->company_reg_ic_number = $request->company_reg_ic_number;
            $sellers->address = $request->address;
            $sellers->latitude = $request->latitude;
            $sellers->longitude = $request->longitude;
            $sellers->handphone_number = $request->handphone_number;
            $sellers->email = $request->email;
            $sellers->password = bcrypt($request->password);
            $sellers->bank_name = $request->bank_name;
            $sellers->bank_acc_holder_name = $request->bank_acc_holder_name;
            $sellers->bank_acc_number = $request->bank_acc_number;
            $sellers->group_id = 21;
            $sellers->save();
            return response($sellers);
        }
    }

    public function index()
    {
        $sellers = User::where('group_id', 21)->get();
        return view('sellers.index', compact('sellers'));
    }

    public function edit($user_id, Request $request)
    {
        $sellers = User::where('user_id', $user_id)->first();
        return view('seller.editSeller', compact('sellers'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $sellers = User::where('user_id', $request->user_id)->first();
            $sellers->name = $request->name;
            $sellers->company_name = $request->company_name;
            $sellers->company_reg_ic_number = $request->company_reg_ic_number;
            $sellers->address = $request->address;
            $sellers->latitude = $request->latitude;
            $sellers->longitude = $request->longitude;
            $sellers->handphone_number = $request->handphone_number;
            $sellers->email = $request->email;
            $sellers->password = bcrypt('$request->password');
            $sellers->bank_name = $request->bank_name;
            $sellers->bank_acc_holder_name = $request->bank_acc_holder_name;
            $sellers->bank_acc_number = $request->bank_acc_number;
            $sellers->save();
            return response($sellers);
        }
    }

    public function delete(Request $request, $user_id)
    {
        $sellers = User::find($user_id);
        $sellers->delete();
        Session::flash('message', 'Successfully deleted');
        return Redirect::to('seller');
    }

    public function show(Request $request, $user_id)
    {
        $seller = User::find($user_id);
        $products = Product::orderBy('name')->paginate();
        return view('sellers.show', compact('seller', 'products'));
    }
}
