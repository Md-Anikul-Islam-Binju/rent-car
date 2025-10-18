<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Fleet;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{


    public function service()
    {
        $services = Service::all()->map(function ($services) {
            // prepend image path
            $services->image = asset('images/service/' . $services->image);
            return $services;
        });

        return response()->json(['services' => $services], 200);
    }

    public function serviceSpecific($slug)
    {
        $serviceSpecific = Service::where('slug', $slug)->first();
        if ($serviceSpecific) {
            // prepend image path
            $serviceSpecific->image = asset('images/service/' . $serviceSpecific->image);
        }
        return response()->json(['service' => $serviceSpecific], 200);
    }



}
