<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return response()->json($blogs, 200);
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($blog);
    }   

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $blog->delete();

        return response()->json(['message' => 'Deleted']);
    }

}



