<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Middleware\ForceJsonResponse;
use App\Http\Requests\StoreInterViewRequest;
use App\Models\City;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class InterViewController extends Controller
{
    public function get(StoreInterViewRequest $request){

        $zips = City::getCities($request['addresses']);
        $vehicles = VehicleType::select('number','minimum', 'cost_km')->get();

        $destination = Helper::getPrice($zips,$vehicles);


        return response()->json($destination);
    }
}
