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
        if (User::where('company_registration_mykad_number', $request->get('company_registration_mykad_number'))->exists()) {
            return response()->json([
                'message' => 'The (company registration / MyKad) number had been used.',
            ], 403);
        }

        if (User::where('email', $request->get('email'))->exists()) {
            return response()->json([
                'message' => 'The email had been used.',
            ], 403);
        }

        $buyer = User::create([
            'name' => $request->get('name'),
            'company_name' => $request->get('company_name'),
            'company_registration_mykad_number' => $request->get('company_registration_mykad_number'),
            'bussiness_hour' => $request->get('bussiness_hour'),
            'address' => $request->get('address'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'mobile_number' => $request->get('mobile_number'),
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'group_id' => 11,
            'status_email' => 0,
            'status_account' => 0,
        ]);

        Mail::send('email.sendemail', ['user' => $buyer], function ($message) use ($buyer) {

            $message->subject('FoodRico Registration - Account Verification');
            $message->from('wanmuz.ada@gmail.com', 'FoodRico Notification');
            $message->to($buyer->email);

        });

        return response()->json($buyer);
    }

    public function getBuyers(Request $request)
    {
        return response()->json(
            User::select(
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
                ->get()
        );
    }

    public function getBuyer($user_id, Request $request)
    {
        return response()->json(
            User::select(
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
                ->find($user_id)
        );
    }
}
