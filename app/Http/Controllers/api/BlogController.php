<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::all()->map(function ($blogs) {
            // prepend image path
            $blogs->image = asset('images/blog/' . $blogs->image);
            return $blogs;
        });

        return response()->json(['blogs' => $blogs], 200);
    }


    public function blogSpecific($id)
    {
        $blogSpecific = Blog::where('id', $id)->first();
        if ($blogSpecific) {
            // prepend image path
            $blogSpecific->image = asset('images/blog/' . $blogSpecific->image);
        }
        return response()->json(['blog' => $blogSpecific], 200);
    }
}
