<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function fleet()
    {
        $fleets = Fleet::all();
        return response()->json(['fleets'=>$fleets],200);
    }
}
