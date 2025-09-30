<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.pages.blog.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $blog = new Blog();
            $blog->title = $request->title;
            $blog->details = $request->details;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/blog'), $file);
                $blog->image = $file;
            }
            $blog->save();
            Toastr::success('Blog Add Successfully', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
                'status' => 'required|in:active,inactive',
            ]);


            $blog = Blog::findOrFail($id);
            $blog->title = $request->title;
            $blog->details = $request->details;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/blog'), $file);
                $blog->image = $file;
            }
            $blog->status = $request->status;
            $blog->save();
            Toastr::success('Blog Update Successfully', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $filePath = public_path('images/blog/' . $blog->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $blog->delete();
            Toastr::success('Blog Delete Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
