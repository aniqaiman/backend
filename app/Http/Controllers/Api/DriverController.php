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

class DriverController extends BaseController
{
	public function postRegisterDriver(Request $request)
    {
        if (User::where('company_reg_ic_number', $request->get('company_reg_ic_number'))->exists()) {
            abort(400, 'The company registration number / ic number had been used.');
        }

        if (User::where('license_number', $request->get('license_number'))->exists()) {
            abort(400, 'The license number had been used.');
        }

        $driver = User::create([
            'name' => $request->get('name'),
            'company_reg_ic_number' => $request->get('company_reg_ic_number'),
            'address' => $request->get('address'),
            'phonenumber' => $request->get('phonenumber'),
            'license_number' => $request->get('license_number'),
            'roadtax_expiry' => $request->get('roadtax_expiry'),
            'type_of_lorry' => $request->get('type_of_lorry'),
            'lorry_capacity' => $request->get('lorry_capacity'),
            'lorry_plate_number' => $request->get('lorry_plate_number'),
            'password' => bcrypt($request->get('password')),
            'group_id'=>31,
            ]);
        return response()->json(['data'=>$driver, 'status'=>'ok']);
    }

    public function getDrivers(Request $request)
    {
        $drivers = User::where('group_id',31)->get();

        $driverArray = [];

        foreach($drivers as $driver)
        {
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

        return response()->json(['data'=>$driverArray, 'status'=>'ok']);
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

        return response()->json(['data'=>$newdriver, 'status'=>'ok']);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}