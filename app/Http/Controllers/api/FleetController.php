<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function fleet()
    {
        $fleets = Fleet::all()->map(function ($fleet) {
            // prepend image path
            $fleet->image = asset('images/fleet/' . $fleet->image);
            return $fleet;
        });

        return response()->json(['fleets' => $fleets], 200);
    }
}
