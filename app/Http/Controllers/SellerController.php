<?php

namespace App\Http\Controllers;

use App\Capacity;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Session;

class SellerController extends Controller
{
    public function createSeller(Request $request)
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

    public function getSellers()
    {
        $sellers = User::where('group_id', 21)->paginate();
        return view('users.sellers', compact('sellers'));
    }

    public function editSeller($user_id, Request $request)
    {
        $sellers = User::where('user_id', $user_id)->first();
        return view('seller.editSeller', compact('sellers'));
    }

    public function updateSeller(Request $request)
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

    public function deleteSeller($user_id, Request $request)
    {
        $sellers = User::find($user_id);
        $sellers->delete();
        Session::flash('message', 'Successfully deleted');
        return Redirect::to('seller');
    }

    public function getSellerDetail($user_id, Request $request)
    {
        $seller = User::where('user_id', $user_id)->first();
        $types = Type::all();
        $capacities = Capacity::all();
        return view('seller.sellerdetail', compact('seller', 'types', 'capacities'));
    }
}
