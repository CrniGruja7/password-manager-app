<?php

namespace App\Services;

use App\Http\Requests\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostService{
    public function __construct()
    {   
        
    }
    public function createPost(StoreRequest $request) {
        return  Post::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'slug' => Str::slug($request->title),
            'content' => $request->content
        ]);
    }
    public function updatePost(StoreRequest $request, $id) {

        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->save();   
        
        return $post;
    }

    public function deletePost(Post $post){
        return $post->delete();
    }
}
