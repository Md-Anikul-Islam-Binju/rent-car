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
        $services = Service::all();
        return response()->json(['services'=>$services],200);
    }
}
