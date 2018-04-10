<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        if ($request->ajax()) {
            return response(Product::create($request->all()));
        }
    }
}
