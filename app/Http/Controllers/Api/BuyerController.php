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
        $buyer = User::create([
            'name' => $request->get('name'),
            'company_name' => $request->get('company_name'),
            'company_reg_ic_number' => $request->get('company_reg_ic_number'),
            'address' => $request->get('address'),
            'handphone_number' => $request->get('handphone_number'),
            'phonenumber' => $request->get('phonenumber'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'group_id'=>11,
            ]);
            return response()->json(['data'=>$buyer, 'status'=>'ok']);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}