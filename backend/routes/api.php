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

Route::post('/create_blog', function (Request $request) {
    $blog = Blog::create([
        'title'     => $request->title,
        'content'   => $request->content,
        'favorite'  => false,
        'category'  => $request->category,
        'datetime'  => Carbon::now()->toDateString(),
        'image_url' => $request->image_url
    ]);
});


Route::get('/blogs/{id}', [BlogController::class, 'show']);

Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);


Route::put('/update/{id}', function (Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'image_url' => 'required|string',
        ]);
        $blog = Blog::findOrFail($id);
        $blog->update($validated);

        return response()->json([
            'message' => 'Cập nhật thành công',
            'blog' => $blog
        ]);
    }
);