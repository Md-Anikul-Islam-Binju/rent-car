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
}
