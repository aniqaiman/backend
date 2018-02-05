<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Fruit;

class FruitController extends Controller
{
    public function createFruit(Request $request)
    {
    	$path = $request->file('fruit_image')->store('public/images');
		if($request->ajax()){
            $fruits = new Fruit;
            $fruits->fruit_name = $request->fruit_name;
            $fruits->fruit_grade = $request->fruit_grade;
            $fruits->fruit_price = $request->fruit_price;
            $fruits->fruit_image = $path;
            $fruits->fruit_quantity = $request->fruit_quantity;
            $fruits->fruit_harvest_duration = $request->fruit_harvest_duration;
            $fruits->save();
            return response($fruits);
        }
    }

    public function getFruit()
    {
    	$fruits = Fruit::all();
	    // $users = User::all();
	    return view('fruit.fruit',compact('fruits'));
    }

    public function editFruit($fruit_id, Request $request)
    {
        $fruits = Fruit::where('group_id', $request->fruit_id)->first();
        return view('fruit.editFruit', compact('fruits'));
    }

    public function updateFruit(Request $request)
    {
    	$path = $request->file('fruit_image')->store('public/images');
        if($request->ajax()){
            $fruits = Fruit::where('fruit_id', $request->fruit_id)->first();
            $fruits->fruit_name = $request->fruit_name;
            $fruits->fruit_grade = $request->fruit_grade;
            $fruits->fruit_price = $request->fruit_price;
            $fruits->fruit_image = $path;
            $fruits->fruit_quantity = $request->fruit_quantity;
            $fruits->fruit_harvest_duration = $request->fruit_harvest_duration;
            $fruits->save();
            return response($fruits);
            }       
    }

    public function deleteFruit($fruit_id, Request $request)
    {
        $fruits = Fruit::find($fruit_id);
        $fruits->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('fruit');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
