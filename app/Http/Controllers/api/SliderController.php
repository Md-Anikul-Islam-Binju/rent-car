<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function slider()
    {
        $slider = Slider::all()->map(function ($slider) {
            // prepend image path
            $slider->image = asset('images/slider/' . $slider->image);
            return $slider;
        });

        return response()->json(['slider' => $slider], 200);
    }
}
