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
use App\Type;
use App\Capacity;

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
            // $drivers->bank_name = $request->bank_name;
            // $drivers->bank_acc_holder_name = $request->bank_acc_holder_name;
            // $drivers->bank_acc_number = $request->bank_acc_number;
            $drivers->save();
            return response($drivers);
		}
    }

    public function getDriver()
    {
    	$drivers = Driver::all();
        $types = Type::all();
        $capacities = Capacity::all();
    	return view('driver.driver', compact('drivers','types','capacities'));
    }

    public function editDriver($driver_id, Request $request)
    {
        $drivers = Driver::where('driver_id', $request->driver_id)->first();
        return view('driver.editDriver', compact('drivers'));
    }

    public function updateDriver(Request $request)
    {
        $path = $request->file('drivers_license')->store('public/images');
        if($request->ajax()){
            $drivers = Driver::where('driver_id', $request->driver_id)->first();
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

    public function deleteDriver($driver_id, Request $request)
    {
        $drivers = Driver::find($driver_id);
        $drivers->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('driver');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
