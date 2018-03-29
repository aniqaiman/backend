<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\User;

class BuyerController extends BaseController
{
	public function postRegisterBuyer(Request $request)
    {
        if (User::where('company_reg_ic_number', $request->get('company_reg_ic_number'))->exists()) {
            abort(400, 'The company registration number / ic number had been used.');
        }

        if (User::where('email', $request->get('email'))->exists()) {
            abort(400, 'The email had been used.');
        }

        $buyer = User::create([
            'name' => $request->get('name'),
            'company_name' => $request->get('company_name'),
            'company_reg_ic_number' => $request->get('company_reg_ic_number'),
            'buss_hour' => $request->get('buss_hour'),
            'address' => $request->get('address'),
            'handphone_number' => $request->get('handphone_number'),
            'phonenumber' => $request->get('phonenumber'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'group_id'=>11,
            ]);
        return response()->json(['data'=>$buyer, 'status'=>'ok']);
    }

    public function getBuyers(Request $request)
    {
        $buyers = User::where('group_id',11)->get();

        $buyerArray = [];

        foreach($buyers as $buyer)
        {
            $newbuyer["user_id"] = $buyer->user_id;
            $newbuyer["name"] = $buyer->name;
            $newbuyer["company_name"] = $buyer->company_name;
            $newbuyer["company_reg_ic_number"] = $buyer->company_reg_ic_number;
            $newbuyer["buss_hour"] = $buyer->buss_hour;
            $newbuyer["address"] = $buyer->address;
            $newbuyer["handphone_number"] = $buyer->handphone_number;
            $newbuyer["phonenumber"] = $buyer->phonenumber;
            $newbuyer["email"] = $buyer->email;
            $newbuyer["group_id"] = $buyer->group_id;

            array_push($buyerArray, $newbuyer);
        }

        return response()->json(['data'=>$buyerArray, 'status'=>'ok']);
    }

    public function getBuyer($user_id, Request $request)
    {
        $buyer = User::where('user_id', $user_id)->first();

        $newbuyer["user_id"] = $buyer->user_id;
        $newbuyer["name"] = $buyer->name;
        $newbuyer["company_name"] = $buyer->company_name;
        $newbuyer["company_reg_ic_number"] = $buyer->company_reg_ic_number;
        $newbuyer["buss_hour"] = $buyer->buss_hour;
        $newbuyer["address"] = $buyer->address;
        $newbuyer["handphone_number"] = $buyer->handphone_number;
        $newbuyer["phonenumber"] = $buyer->phonenumber;
        $newbuyer["email"] = $buyer->email;
        $newbuyer["group"] = $buyer->groups->group_name;

        return response()->json(['data'=>$newbuyer, 'status'=>'ok']);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}