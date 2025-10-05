<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.pages.service.index', compact('services'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'type' => 'required',
                'details' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);
            $service = new Service();
            $service->name = $request->name;
            $service->type = $request->type;
            $service->short_details = $request->short_details;
            $service->details = $request->details;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/service'), $file);
                $service->image = $file;
            }
            $service->save();
            Toastr::success('Service Add Successfully', 'Success');
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
                'type' => 'required',
            ]);
            $service = Service::findOrFail($id);
            $service->name = $request->name;
            $service->type = $request->type;
            $service->short_details = $request->short_details;
            $service->details = $request->details;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/service'), $file);
                $service->image = $file;
            }
            $service->status = $request->status;
            $service->save();
            Toastr::success('Service Update Successfully', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            $filePath = public_path('images/service/' . $service->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $service->delete();
            Toastr::success('Service Delete Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
