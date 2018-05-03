<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mail;

class SellerController extends Controller
{
    public function postRegisterSeller(Request $request)
    {
        if (User::where('company_registration_mykad_number', $request->input('company_registration_mykad_number'))->exists()) {
            return response()->json([
                'message' => 'The (company registration / MyKad) number had been used.',
            ], 403);
        }

        if (User::where('email', $request->input('email'))->exists()) {
            return response()->json([
                'message' => 'The email had been used.',
            ], 403);
        }

        $seller = User::create([
            'name' => $request->input('name'),
            'company_name' => $request->input('company_name'),
            'company_registration_mykad_number' => $request->input('company_registration_mykad_number'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'mobile_number' => $request->input('mobile_number'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'group_id' => 21,
            'status_email' => 0,
            'status_account' => 0,
        ]);

        $seller->activation_token = Crypt::encryptString($seller->id);

        Mail::send('email.registration_sucess', ['user' => $seller], function ($message) use ($seller) {

            $message->subject('FoodRico Registration - Account Verification');
            $message->from('wanmuz.ada@gmail.com', 'FoodRico Notification');
            $message->to($seller->email);

        });

        return response()->json([
            "data" => $seller,
        ]);
    }

    public function getSellers(Request $request)
    {
        $sellers = User::where('group_id', 21)->get();

        $sellerArray = [];

        foreach ($sellers as $seller) {
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

        return response()->json(['data' => $sellerArray, 'status' => 'ok']);
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

        return response()->json(['data' => $newseller, 'status' => 'ok']);
    }
}
