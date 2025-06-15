<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/blogs', BlogController::class);

Route::post('/blogs', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'title'     => 'required|string',
        'content'   => 'required|string',
        'category'  => 'required|string',
        'image'     => 'nullable|image|max:5120'
    ]);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
    }

    $blog = Blog::create([
        'title'     => $request->title,
        'content'   => $request->content,
        'favorite'  => false,
        'category'  => $request->category,
        'datetime'  => Carbon::now()->toDateString(),
        'image_url' => $imagePath
    ]);
    return response()->json([
        'message' => 'Thành công',
        'data'    => $blog
    ], 201);
});


Route::get('/blogs/{id}', [BlogController::class, 'show']);

Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);


Route::post('/blogs/{id}', function (Request $request, $id) {
    if (strtoupper($request->get('_method')) === 'PUT') {
        $blog = Blog::find($id);
        $blog->title = $request->input('title', $blog->title);
        $blog->category = $request->input('category', $blog->category);
        $blog->content = $request->input('content', $blog->content);

        if ($request->hasFile('image')) {
            if ($blog->image_url) {
                Storage::disk('public')->delete($blog->image);
            }
            $path = $request->file('image')->store('uploads', 'public');
            $blog->image_url = $path;
        }

        $blog->save();

        return response()->json([
            'message' => 'Cập nhật thành công',
            'blog' => $blog
        ]);
    }
});