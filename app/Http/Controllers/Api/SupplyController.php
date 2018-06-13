<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class SupplyController extends Controller
{
    public function getSupplies()
    {
        return response()->json([
            'data' => JWTAuth::parseToken()->authenticate()
                ->supplies()
                ->with('category')
                ->get(),
        ]);
    }

    public function postSupplies(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->supplies()->detach();

        foreach ($request->all() as $supply) {
            $user->syncWithoutDetaching([$supply->product->id => [
                'harvesting_period_start' => $request->harvestingPeriodStart,
                'harvesting_period_end' => $request->harvestingPeriodEnd,
                'harvest_frequency' => $request->harvestFrequency,
                'total_plants' => $request->totalPlants,
                'total_farm_area' => $request->totalFarmArea,
            ]]);
        }

        return response()->json([
            "data" => $user,
        ]);
    }
}
