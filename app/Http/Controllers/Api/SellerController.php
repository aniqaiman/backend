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

class SellerController extends BaseController
{
	public function postRegisterSeller(Request $request)
    {
        $seller = User::create([
            'name' => $request->get('name'),
            'company_name' => $request->get('company_name'),
            'company_reg_ic_number' => $request->get('company_reg_ic_number'),
            'address' => $request->get('address'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'handphone_number' => $request->get('handphone_number'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            // 'bank_name' => $request->get('bank_name'),
            // 'bank_acc_holder_name' => $request->get('bank_acc_holder_name'),
            // 'bank_acc_number' => $request->get('bank_acc_number'),
            'group_id'=>21,
            ]);
        return response()->json(['data'=>$seller, 'status'=>'ok']);
    }

    public function getSellers(Request $request)
    {
        $sellers = User::where('group_id',21)->get();

        $sellerArray = [];

        foreach($sellers as $seller)
        {
            $newseller["user_id"] = $seller->user_id;
            $newseller["name"] = $seller->name;
            $newseller["company_name"] = $seller->company_name;
            $newseller["company_reg_ic_number"] = $seller->company_reg_ic_number;
            $newseller["address"] = $seller->address;
            $newseller["latitude"] = $seller->latitude;
            $newseller["longitude"] = $seller->longitude;
            $newseller["handphone_number"] = $seller->handphone_number;
            $newseller["email"] = $seller->email;
            $newseller["group_id"] = $seller->group_id;

            array_push($sellerArray, $newseller);
        }

        return response()->json(['data'=>$sellerArray, 'status'=>'ok']);
    }

    public function getSeller($user_id, Request $request)
    {
        $seller = User::where('user_id', $user_id)->first();

        $newseller["user_id"] = $seller->user_id;
        $newseller["name"] = $seller->name;
        $newseller["company_name"] = $seller->company_name;
        $newseller["company_reg_ic_number"] = $seller->company_reg_ic_number;
        $newseller["address"] = $seller->address;
        $newseller["latitude"] = $seller->latitude;
        $newseller["longitude"] = $seller->longitude;
        $newseller["handphone_number"] = $seller->handphone_number;
        $newseller["email"] = $seller->email;
        $newseller["group"] = $seller->groups->group_name;

        return response()->json(['data'=>$newseller, 'status'=>'ok']);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}