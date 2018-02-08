<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Buyer;

class BuyerController extends BaseController
{
	public function postRegisterBuyer(Request $request)
    {
        $buyer = Buyer::create([
            'owner_name' => $request->get('owner_name'),
            // 'company_name' => $request->get('company_name'),
            // 'company_reg_number' => $request->get('company_reg_number'),
            'ic_number' => $request->get('ic_number'),
            'company_address' => $request->get('company_address'),
            'handphone_number' => $request->get('handphone_number'),
            // 'phone_number' => $request->get('phone_number'),
            'email_address' => $request->get('email_address'),
            'password' => bcrypt($request->get('password')),
            'group_id'=>11,
            ]);
            return response()->json(['data'=>$buyer, 'status'=>'ok']);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}