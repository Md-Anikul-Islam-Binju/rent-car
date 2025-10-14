<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('admin.pages.slider.index', compact('slider'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $slider = new Slider();
            $slider->name = $request->name;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/slider'), $file);
                $slider->image = $file;
            }
            $slider->save();
            Toastr::success('Slider Add Successfully', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);


            $slider = Slider::findOrFail($id);
            $slider->name = $request->name;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/slider'), $file);
                $slider->image = $file;
            }
            $slider->status = $request->status;
            $slider->save();
            Toastr::success('Slider Update Successfully', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $filePath = public_path('images/slider/' . $slider->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $slider->delete();
            Toastr::success('Slider Delete Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
