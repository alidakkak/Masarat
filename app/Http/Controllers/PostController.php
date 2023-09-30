<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Pagination\Paginator;
use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $post = Post::with('images')->paginate(10);
        return PostResource::collection($post);
    }

    public function recentlyAdd() {
        $recently = Post::latest()->take(5)->get();
        return $recently;
    }

    public function getTodaysPosts() {

        $today = Carbon::now()->format('Y-m-d');

        $posts = Post::whereDate('created_at', $today)->get();

        return response()->json($posts);
    }

    public function store(StorePostRequest $request) {
        $request->validated($request->all());
        $images = $request->image;
        $post = Post::create($request->all());
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
               Image::create([
                'post_id' => $post->id,
                'image' => $image
               ]);
            }
        }
        return PostResource::make($post);
    }
    
}