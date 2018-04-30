<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Mail;

class BuyerController extends Controller
{
    public function postRegisterBuyer(Request $request)
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

        $buyer = User::create([
            'name' => $request->input('name'),
            'company_name' => $request->input('company_name'),
            'company_registration_mykad_number' => $request->input('company_registration_mykad_number'),
            'bussiness_hour' => $request->input('bussiness_hour'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'mobile_number' => $request->input('mobile_number'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'group_id' => 11,
            'status_email' => 0,
            'status_account' => 0,
        ]);

        Mail::send('email.sendemail', ['user' => $buyer], function ($message) use ($buyer) {

            $message->subject('FoodRico Registration - Account Verification');
            $message->from('wanmuz.ada@gmail.com', 'FoodRico Notification');
            $message->to($buyer->email);

        });

        return response()->json([
            "data" => $buyer,
        ]);
    }

    public function getBuyers(Request $request)
    {
        return response()->json([
            "data" => User::select(
                'id',
                'name',
                'company_name',
                'company_registration_mykad_number',
                'bussiness_hour',
                'address',
                'latitude',
                'longitude',
                'mobile_number',
                'phone_number',
                'email'
            )
                ->where('group_id', 11)
                ->get(),
        ]);
    }

    public function getBuyer($user_id, Request $request)
    {
        return response()->json([
            "data" => User::select(
                'id',
                'name',
                'company_name',
                'company_registration_mykad_number',
                'bussiness_hour',
                'address',
                'latitude',
                'longitude',
                'mobile_number',
                'phone_number',
                'email'
            )
                ->find($user_id),
        ]);
    }
}
