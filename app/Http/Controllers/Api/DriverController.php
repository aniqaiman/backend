<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Mail;

class DriverController extends Controller
{
    public function postRegisterDriver(Request $request)
    {
        if (User::where('company_reg_ic_number', $request->input('company_reg_ic_number'))->exists()) {
            return response()->json([
                'message' => 'The company Reg. No. / MyKad No. had been used.',
            ], 403);
        }

        if (User::where('license_number', $request->input('license_number'))->exists()) {
            return response()->json([
                'message' => 'The license number had been used.',
            ], 403);
        }

        $driver = User::create([
            'name' => $request->input('name'),
            'company_reg_ic_number' => $request->input('company_reg_ic_number'),
            'address' => $request->input('address'),
            'phonenumber' => $request->input('phonenumber'),
            'license_number' => $request->input('license_number'),
            'roadtax_expiry' => $request->input('roadtax_expiry'),
            'type_of_lorry' => $request->input('type_of_lorry'),
            'lorry_capacity' => $request->input('lorry_capacity'),
            'lorry_plate_number' => $request->input('lorry_plate_number'),
            'password' => bcrypt($request->input('password')),
            'group_id' => 31,
        ]);
        $userEmail = $request->email;

        Mail::send('email.sendemail', ['user' => $driver], function ($message) use ($userEmail) {

            $message->from('wanmuz.ada@gmail.com', 'Admin');

            $message->to($userEmail);

        });
        return response()->json(['data' => $driver, 'status' => 'ok']);
    }

    public function getDrivers(Request $request)
    {
        $drivers = User::where('group_id', 31)->get();

        $driverArray = [];

        foreach ($drivers as $driver) {
            $newdriver["user_id"] = $driver->user_id;
            $newdriver["name"] = $driver->name;
            $newdriver["company_reg_ic_number"] = $driver->company_reg_ic_number;
            $newdriver["address"] = $driver->address;
            $newdriver["phonenumber"] = $driver->phonenumber;
            $newdriver["license_number"] = $driver->license_number;
            $newdriver["roadtax_expiry"] = $driver->roadtax_expiry;
            $newdriver["type_of_lorry"] = $driver->types->type;
            $newdriver["lorry_capacity"] = $driver->capacities->capacity;
            $newdriver["lorry_plate_number"] = $driver->lorry_plate_number;
            $newdriver["group_id"] = $driver->group_id;

            array_push($driverArray, $newdriver);
        }

        return response()->json(['data' => $driverArray, 'status' => 'ok']);
    }

    public function getDriver($user_id, Request $request)
    {
        $driver = User::where('user_id', $user_id)->first();

        $newdriver["user_id"] = $driver->user_id;
        $newdriver["name"] = $driver->name;
        $newdriver["company_reg_ic_number"] = $driver->company_reg_ic_number;
        $newdriver["address"] = $driver->address;
        $newdriver["phonenumber"] = $driver->phonenumber;
        $newdriver["license_number"] = $driver->license_number;
        $newdriver["roadtax_expiry"] = $driver->roadtax_expiry;
        $newdriver["type_of_lorry"] = $driver->types->type;
        $newdriver["lorry_capacity"] = $driver->capacities->capacity;
        $newdriver["lorry_plate_number"] = $driver->lorry_plate_number;
        $newdriver["group"] = $driver->groups->group_name;

        return response()->json(['data' => $newdriver, 'status' => 'ok']);
    }
}
