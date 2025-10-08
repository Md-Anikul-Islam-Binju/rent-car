<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fleet;
use Yoeunes\Toastr\Facades\Toastr;

class FleetController extends Controller
{
    public function index()
    {
        $fleets = Fleet::all();
        return view('admin.pages.fleet.index', compact('fleets'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'model' => 'required',
                'number' => 'required',
                'total_seats' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $fleet = new Fleet();
            $fleet->name = $request->name;
            $fleet->model = $request->model;
            $fleet->number = $request->number;
            $fleet->base_fare = $request->base_fare;
            $fleet->checking_bag = $request->checking_bag;
            $fleet->carry_bag = $request->carry_bag;
            $fleet->short_details = $request->short_details;
            $fleet->per_kilometer_fare = $request->per_kilometer_fare;
            $fleet->per_kilometer_fare_duration_wise = $request->per_kilometer_fare_duration_wise;
            $fleet->total_bag = $request->total_bag;
            $fleet->details = $request->details;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/fleet'), $file);
                $fleet->image = $file;
            }
            $fleet->save();
            Toastr::success('Fleet Add Successfully', 'Success');
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
                'model' => 'required',
                'number' => 'required',
                'total_seats' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
                'status' => 'required|in:active,inactive',
            ]);


            $fleet = Fleet::findOrFail($id);
            $fleet->name = $request->name;
            $fleet->model = $request->model;
            $fleet->number = $request->number;
            $fleet->total_seats = $request->total_seats;
            $fleet->checking_bag = $request->checking_bag;
            $fleet->carry_bag = $request->carry_bag;
            $fleet->base_fare = $request->base_fare;
            $fleet->short_details = $request->short_details;
            $fleet->per_kilometer_fare = $request->per_kilometer_fare;
            $fleet->per_kilometer_fare_duration_wise = $request->per_kilometer_fare_duration_wise;
            $fleet->details = $request->details;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/fleet'), $file);
                $fleet->image = $file;
            }
            $fleet->status = $request->status;
            $fleet->save();
            Toastr::success('Fleet Update Successfully', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $fleet = Fleet::findOrFail($id);
            $filePath = public_path('images/fleet/' . $fleet->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $fleet->delete();
            Toastr::success('Fleet Delete Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
