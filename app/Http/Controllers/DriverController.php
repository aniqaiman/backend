<?php

namespace App\Http\Controllers;

use App\LorryCapacity;
use App\LorryType;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Session;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $path = $request->file('drivers_license')->store('public/images');
        if ($request->ajax()) {
            $drivers = new User;
            $drivers->name = $request->name;
            $drivers->company_reg_ic_number = $request->company_reg_ic_number;
            $drivers->address = $request->address;
            $drivers->phonenumber = $request->phonenumber;
            $drivers->license_number = $request->license_number;
            $drivers->drivers_license = $path;
            $drivers->roadtax_expiry = $request->roadtax_expiry;
            $drivers->type_of_lorry = $request->type_of_lorry;
            $drivers->lorry_capacity = $request->lorry_capacity;
            $drivers->location_to_cover = $request->location_to_cover;
            $drivers->lorry_plate_number = $request->lorry_plate_number;
            $drivers->password = bcrypt($request->password);
            $drivers->group_id = 31;
            // $drivers->bank_name = $request->bank_name;
            // $drivers->bank_acc_holder_name = $request->bank_acc_holder_name;
            // $drivers->bank_acc_number = $request->bank_acc_number;
            $drivers->save();
            return response($drivers);
        }
    }

    public function index()
    {
        $drivers = User::where('group_id', 31)->get();
        $types = LorryType::all();
        $capacities = LorryCapacity::all();
        return view('driver.driver', compact('drivers', 'types', 'capacities'));
    }

    public function edit($user_id, Request $request)
    {
        $drivers = User::where('user_id', $user_id)->first();
        $types = Type::all();
        $capacities = Capacity::all();
        return view('driver.editDriver', compact('drivers', 'types', 'capacities'));
    }

    public function update(Request $request)
    {
        $path = $request->file('drivers_license')->store('public/images');
        if ($request->ajax()) {
            $drivers = User::where('user_id', $request->user_id)->first();
            $drivers->name = $request->name;
            $drivers->company_reg_ic_number = $request->company_reg_ic_number;
            $drivers->address = $request->address;
            $drivers->phonenumber = $request->phonenumber;
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
            $drivers->password = bcrypt('$request->password');
            $drivers->save();
            return response($drivers);
        }
    }

    public function delete($user_id, Request $request)
    {
        $drivers = User::find($user_id);
        $drivers->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('driver');
    }

    public function show($user_id, Request $request)
    {
        $driver = User::where('user_id', $user_id)->first();
        $types = Type::all();
        $capacities = Capacity::all();
        return view('driver.driverdetail', compact('driver', 'types', 'capacities'));
    }
}
