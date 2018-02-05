<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Driver;

class DriverController extends Controller
{
    public function createDriver(Request $request)
    {
    	$path = $request->file('drivers_license')->store('public/images');
		if($request->ajax()){
            $drivers = new Driver;
            $drivers->name = $request->name;
            $drivers->ic_number = $request->ic_number;
            $drivers->home_address = $request->home_address;
            $drivers->phone_number = $request->phone_number;
            $drivers->license_number = $request->license_number;
            $drivers->drivers_license = $path;
            $drivers->roadtax_expiry = $request->roadtax_expiry;
            $drivers->type_of_lorry = $request->type_of_lorry;
            $drivers->lorry_capacity = $request->lorry_capacity;
            $drivers->location_to_cover = $request->location_to_cover;
            $drivers->lorry_plate_number = $request->lorry_plate_number;
            $drivers->bank_name = $request->bank_name;
            $drivers->bank_acc_holder_name = $request->bank_acc_holder_name;
            $drivers->bank_acc_number = $request->bank_acc_number;
            $drivers->save();
            return response($drivers);
		}
    }

    public function getDriver()
    {
    	$drivers = Driver::all();
    	return view('driver.driver', compact('drivers'));
    }
}
