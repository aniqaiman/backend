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

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}