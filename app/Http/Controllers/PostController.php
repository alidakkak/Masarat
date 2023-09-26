<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $post = Post::with('images')->get();
        return PostResource::collection($post);
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