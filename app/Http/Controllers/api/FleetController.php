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

    public function fleetSpecific($id)
    {
        $fleetSpecific = Fleet::where('id', $id)->first();
        if ($fleetSpecific) {
            // prepend image path
            $fleetSpecific->image = asset('images/fleet/' . $fleetSpecific->image);
        }
        return response()->json(['fleet' => $fleetSpecific], 200);
    }

}
