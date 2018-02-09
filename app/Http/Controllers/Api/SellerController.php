<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Seller;

class SellerController extends BaseController
{
	public function postRegisterSeller(Request $request)
    {
        $seller = Seller::create([
            'owner_name' => $request->get('owner_name'),
            // 'company_name' => $request->get('company_name'),
            // 'registration_number' => $request->get('registration_number'),
            'ic_number' => $request->get('ic_number'),
            'farm_address' => $request->get('farm_address'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'handphone_number' => $request->get('handphone_number'),
            'email_address' => $request->get('email_address'),
            'password' => bcrypt($request->get('password')),
            // 'bank_name' => $request->get('bank_name'),
            // 'bank_acc_holder_name' => $request->get('bank_acc_holder_name'),
            // 'bank_acc_number' => $request->get('bank_acc_number'),
            'group_id'=>1,
            ]);
            return response()->json(['data'=>$seller, 'status'=>'ok']);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}